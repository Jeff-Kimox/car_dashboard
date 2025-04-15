<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



// implements Tenant


class Company extends Model 
{
    //
    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'company_user')->withTimestamps();
    }


    // public function getTenantKeyName(): string
    // {
    //     return 'id';
    // }
}
