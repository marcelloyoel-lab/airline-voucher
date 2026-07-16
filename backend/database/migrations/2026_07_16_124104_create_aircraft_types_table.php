<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aircraft_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedTinyInteger('max_rows');
            $table->json('seats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aircraft_types');
    }
};
