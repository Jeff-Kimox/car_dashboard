<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'vin_number',
        'make',
        'model',
        'year',
        'color',
        'mileage',
        'engine_type',
        'transmission',
        'body_type',
        'plate_number',
        'car_owner_id',
        'notes',
    ];

    public function owner()
    {
        return $this->belongsTo(CarOwner::class, 'car_owner_id');
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}