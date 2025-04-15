<?php

namespace App\Models;

use App\Enums\TripStatus;
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
        'status',
        'accident_photo'
    ];

    // protected $cast = [
    //     'status' => TripStatus::class,
    // ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carOwner()
    {
        return $this->belongsTo(CarOwner::class);
    }
}
