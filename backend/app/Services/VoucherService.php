<?php

namespace App\Services;

use App\Models\Voucher;

class VoucherService
{
    public function check(array $data): bool
    {
        return Voucher::query()
            ->where('flight_number', $data['flightNumber'])
            ->where('flight_date', $data['date'])
            ->exists();
    }
}