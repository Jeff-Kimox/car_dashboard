<?php

namespace App\Filament\Resources\CarOwnerResource\Pages;

use App\Filament\Resources\CarOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCarOwner extends EditRecord
{
    protected static string $resource = CarOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
