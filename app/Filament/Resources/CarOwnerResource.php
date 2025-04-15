<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarOwnerResource\Pages;
use App\Filament\Resources\CarOwnerResource\RelationManagers;
use App\Models\CarOwner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarOwnerResource extends Resource
{
    protected static ?string $model = CarOwner::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Car Management';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('car_owner_id', app('currentTenant')->id);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->tel()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->sortable(),
                Tables\Columns\TextColumn::make('phone'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarOwners::route('/'),
            'create' => Pages\CreateCarOwner::route('/create'),
            'edit' => Pages\EditCarOwner::route('/{record}/edit'),
        ];
    }
}
