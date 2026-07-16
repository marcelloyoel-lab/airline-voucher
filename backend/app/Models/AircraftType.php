<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AircraftType extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'seats' => 'array',
    ];
}
