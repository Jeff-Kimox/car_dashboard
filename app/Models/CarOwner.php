<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarOwner extends Model
{
    protected $fillable = ['name', 'contact'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}

