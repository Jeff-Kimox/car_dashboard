<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CarOwner;
use App\Models\Company;
use Filament\Panel;
use Filament\PanelProvider;

class TenantPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('tenant')
            ->path('{car_owner}/admin') // Panel path contains tenant slug
            ->login()
            ->tenant(Company::class, 'slug') // Resolves CarOwner via route binding
            ->discoverResources(in: app_path('Filament/Tenant/Resources'))
            ->discoverPages(in: app_path('Filament/Tenant/Pages'))
            ->discoverWidgets(in: app_path('Filament/Tenant/Widgets'))
            ->brandName('Car Owner Panel');
    }
}
