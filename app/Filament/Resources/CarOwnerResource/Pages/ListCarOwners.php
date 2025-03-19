<?php

namespace App\Filament\Resources\CarOwnerResource\Pages;

use App\Filament\Resources\CarOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarOwners extends ListRecords
{
    protected static string $resource = CarOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
