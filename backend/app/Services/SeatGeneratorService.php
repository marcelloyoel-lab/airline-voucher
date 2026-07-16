<?php

namespace App\Services;

use App\Models\AircraftType;

class SeatGeneratorService
{
    /**
     * Generate three unique random seats based on the aircraft layout.
     *
     * @param AircraftType $aircraftType
     * @return array<int, string>
     */
    public function generate(AircraftType $aircraftType): array
    {
        $availableSeats = $this->buildSeatMap($aircraftType);

        shuffle($availableSeats);

        return array_slice($availableSeats, 0, 3);
    }

    /**
     * Build all valid seats for the given aircraft.
     *
     * @param AircraftType $aircraftType
     * @return array<int, string>
     */
    private function buildSeatMap(AircraftType $aircraftType): array
    {
        $seatMap = [];

        for ($row = 1; $row <= $aircraftType->max_rows; $row++) {
            foreach ($aircraftType->seats as $seat) {
                $seatMap[] = $row . $seat;
            }
        }

        return $seatMap;
    }
}