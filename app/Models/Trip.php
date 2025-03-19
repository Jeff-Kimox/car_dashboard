<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'driver_id',
        'car_id',
        'from_location',
        'to_location',
        'started_at',
        'ended_at',
        'accident_photo'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
