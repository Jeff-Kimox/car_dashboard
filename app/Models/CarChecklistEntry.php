<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarChecklistEntry extends Model
{
    //
    use HasFactory;

    protected $table = 'car_checklists';

    protected $fillable = [
        'car_id',
        'mileage',
        'checked_at',
        'tires_checked',
        'oil_level_checked',
        'lights_checked',
        'brakes_checked',
        'notes',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id');
    }
}
