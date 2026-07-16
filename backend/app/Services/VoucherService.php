<?php

namespace App\Services;

use App\Exceptions\VoucherAlreadyGeneratedException;
use App\Models\AircraftType;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VoucherService
{
    public function __construct(
        protected SeatGeneratorService $seatGeneratorService
    ) {
    }

    public function check(array $data): bool
    {
        return Voucher::query()
            ->where('flight_number', $data['flightNumber'])
            ->where('flight_date', $data['date'])
            ->exists();
    }

    public function generate(array $data): Voucher
    {
        if ($this->check([
            'flightNumber' => $data['flightNumber'],
            'date' => $data['date'],
        ])) {
            throw new VoucherAlreadyGeneratedException(
                'Voucher has already been generated for this flight.'
            );
        }

        $aircraftType = AircraftType::query()
            ->where('name', $data['aircraft'])
            ->firstOrFail();

        DB::beginTransaction();

        try {
            $seats = $this->seatGeneratorService->generate($aircraftType);

            $voucher = Voucher::create([
                'crew_name'        => $data['name'],
                'crew_id'          => $data['id'],
                'flight_number'    => $data['flightNumber'],
                'flight_date'      => $data['date'],
                'aircraft_type' => $aircraftType->name,
                'seat1'            => $seats[0],
                'seat2'            => $seats[1],
                'seat3'            => $seats[2],
            ]);

            DB::commit();

            Log::info('Voucher generated successfully.', [
                'voucher_id'    => $voucher->id,
                'crew_id'       => $voucher->crew_id,
                'flight_number' => $voucher->flight_number,
                'flight_date'   => $voucher->flight_date,
                'aircraft'      => $aircraftType->name,
                'seats'         => $seats,
            ]);

            return $voucher;
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Failed to generate voucher.', [
                'crew_name'     => $data['name'],
                'crew_id'       => $data['id'],
                'flight_number' => $data['flightNumber'],
                'flight_date'   => $data['date'],
                'aircraft'      => $data['aircraft'],
                'exception'     => $e->getMessage(),
                'trace'         => $e->getTraceAsString(),
            ]);

            throw $e;
        }
    }
}