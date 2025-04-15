<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add HasFactory
use Illuminate\Foundation\Auth\User as Authenticatable; // Correct base class

class Driver extends Authenticatable 
{
    use HasFactory;

    protected $table = 'drivers';

    protected $guard = 'driver';


    protected $fillable = ['name', 'email', 'password', 'rating'];

    protected $hidden = ['password', 'remember_token']; // Add hidden fields

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($driver) {
            $driver->password = bcrypt($driver->password); // Ensure passwords are hashed
        });
    }

    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }

    public function carOwner()
    {
        return $this->belongsTo(CarOwner::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(CarOwner::class);
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->teams;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->teams()->whereKey($tenant)->exists();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('car_owner_id', tenant()->id);
    }

}