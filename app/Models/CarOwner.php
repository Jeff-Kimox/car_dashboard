<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
// use Filament\Models\Contracts\Tenant;
use Filament\MultiTenant\Contracts\Tenant;


class CarOwner extends Model implements Tenant
{
    protected $fillable = ['name', 'contact', 'slug'];

    protected static function booted()
    {
        static::creating(function ($carOwner) {
            if (empty($carOwner->slug)) {
                $carOwner->slug = Str::slug($carOwner->name . '-' . Str::random(5));
            }
        });
    }

    /**
     * Automatically use slug for route model binding.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)->firstOrFail();
    }

    /**
     * Relationship: One car owner has many cars.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    /**
     * Relationship: Many-to-many with drivers.
     */
    public function drivers()
    {
        return $this->belongsToMany(Driver::class);
    }

    /**
     * Relationship: Many-to-many with users (admin/staff).
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Required by Filament to uniquely identify the tenant.
     */
    public function getTenantKeyName(): string
    {
        return 'slug';
    }
}
