<?php

namespace Tests\Feature;

use App\Models\AircraftType;
use App\Models\Voucher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VoucherApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        AircraftType::create([
            'name' => 'ATR',
            'max_rows' => 18,
            'seats' => ['A', 'C', 'D', 'F'],
        ]);
    }

    /** @test */
    public function check_returns_false_when_voucher_does_not_exist(): void
    {
        $response = $this->postJson('/api/check', [
            'flightNumber' => 'GA402',
            'date' => '2026-07-16',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
                'exists' => false,
            ]);
    }

    /** @test */
    public function check_returns_true_when_voucher_exists(): void
    {
        Voucher::create([
            'crew_name' => 'John Doe',
            'crew_id' => 'EMP001',
            'flight_number' => 'GA402',
            'flight_date' => '2026-07-16',
            'aircraft_type' => 'ATR',
            'seat1' => '1A',
            'seat2' => '2C',
            'seat3' => '3D',
        ]);

        $response = $this->postJson('/api/check', [
            'flightNumber' => 'GA402',
            'date' => '2026-07-16',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
                'exists' => true,
            ]);
    }

    /** @test */
    public function check_returns_validation_errors(): void
    {
        $response = $this->postJson('/api/check', []);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'flightNumber',
                'date',
            ]);
    }

    /** @test */
    public function generate_creates_voucher_successfully(): void
    {
        $response = $this->postJson('/api/generate', [
            'name' => 'John Doe',
            'id' => 'EMP001',
            'flightNumber' => 'GA402',
            'date' => '2026-07-16',
            'aircraft' => 'ATR',
        ]);

        $response
            ->assertCreated()
            ->assertJsonStructure([
                'success',
                'seats',
            ]);

        $this->assertDatabaseHas('vouchers', [
            'crew_name' => 'John Doe',
            'crew_id' => 'EMP001',
            'flight_number' => 'GA402',
            'flight_date' => '2026-07-16',
            'aircraft_type' => 'ATR',
        ]);
    }

    /** @test */
    public function generate_returns_conflict_when_voucher_already_exists(): void
    {
        Voucher::create([
            'crew_name' => 'John Doe',
            'crew_id' => 'EMP001',
            'flight_number' => 'GA402',
            'flight_date' => '2026-07-16',
            'aircraft_type' => 'ATR',
            'seat1' => '1A',
            'seat2' => '2C',
            'seat3' => '3D',
        ]);

        $response = $this->postJson('/api/generate', [
            'name' => 'Jane Doe',
            'id' => 'EMP002',
            'flightNumber' => 'GA402',
            'date' => '2026-07-16',
            'aircraft' => 'ATR',
        ]);

        $response
            ->assertStatus(409)
            ->assertJson([
                'message' => 'Voucher has already been generated for this flight.',
            ]);
    }

    /** @test */
    public function generate_returns_validation_errors(): void
    {
        $response = $this->postJson('/api/generate', []);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'id',
                'flightNumber',
                'date',
                'aircraft',
            ]);
    }

    /** @test */
    public function generated_seats_are_unique(): void
    {
        $response = $this->postJson('/api/generate', [
            'name' => 'John Doe',
            'id' => 'EMP001',
            'flightNumber' => 'GA999',
            'date' => '2026-07-17',
            'aircraft' => 'ATR',
        ]);

        $response->assertCreated();

        $seats = $response->json('seats');

        $this->assertCount(3, $seats);
        $this->assertCount(3, array_unique($seats));
    }
}