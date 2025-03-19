<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Correct base class
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add HasFactory
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'rating'];

    protected $hidden = ['password', 'remember_token']; // Add hidden fields

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}