<?php

namespace App\Filament\Widgets;

use App\Models\Car;
use App\Models\Driver;
use App\Models\Trip;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Cars', Car::count())
                ->description('All registered cars')
                // ->icon('lucide-car')
                ->color('primary'),

            Stat::make('Total Drivers', Driver::count())
                ->description('Active drivers in the system')
                // ->icon('lucide-user')
                ->color('success'),

            Stat::make('Total Trips', Trip::count())
                ->description('Completed and active trips')
                // ->icon('lucide-map')
                ->color('info'),

            Stat::make('Average Driver Rating', number_format(Driver::avg('rating') ?? 0, 2))
                ->description('Current average rating')
                // ->icon('lucide-star')
                ->color('warning'),
        ];
    }
}
