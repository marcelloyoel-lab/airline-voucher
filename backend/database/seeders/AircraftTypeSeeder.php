<?php

namespace Database\Seeders;

use App\Models\AircraftType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AircraftTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AircraftType::create([
            'name' => 'ATR',
            'max_rows' => 18,
            'seats' => ['A', 'C', 'D', 'F'],
        ]);

        AircraftType::create([
            'name' => 'Airbus 320',
            'max_rows' => 32,
            'seats' => ['A', 'B', 'C', 'D', 'E', 'F'],
        ]);

        AircraftType::create([
            'name' => 'Boeing 737 Max',
            'max_rows' => 32,
            'seats' => ['A', 'B', 'C', 'D', 'E', 'F'],
        ]);
    }
}
