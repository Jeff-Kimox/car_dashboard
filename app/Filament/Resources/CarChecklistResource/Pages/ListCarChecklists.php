<?php

namespace App\Filament\Resources\CarChecklistResource\Pages;

use App\Filament\Resources\CarChecklistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarChecklists extends ListRecords
{
    protected static string $resource = CarChecklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
