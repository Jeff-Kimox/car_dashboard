<?php

namespace App\Models;

use Filament\Panel;
use Illuminate\Support\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
// use Filament\Models\Contracts\FilamentUser;
// use Filament\Models\Contracts\HasTenants;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasDefaultTenant;
use Filament\Models\Contracts\HasTenants;

class User extends Authenticatable implements FilamentUser, HasTenants, HasDefaultTenant
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_user')->withTimestamps();
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->companies->contains($tenant);
    }

    public function getTenants(Panel $panel): array|Collection
    {
        return $this->companies ?? [];
    }

    public function getDefaultTenant(Panel $panel): ?Model
    {
        return $this->companies()->first();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // Or add logic like checking roles or permissions
    }
 
    
}
