<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarResource\Pages;
use App\Filament\Resources\CarResource\RelationManagers;
use App\Models\Car;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarResource extends Resource
{
    protected static ?string $model = Car::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Car Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('car_owner_id')
                ->relationship('owner', 'name')
                ->label('Owner')
                ->required(),
                Forms\Components\TextInput::make('vin_number')->required(),
                Forms\Components\TextInput::make('make')->required(),
                Forms\Components\TextInput::make('model')->required(),
                Forms\Components\TextInput::make('year')->numeric()->required(),
                Forms\Components\TextInput::make('color')->required(),
                Forms\Components\TextInput::make('mileage')->numeric()->required(),
                Forms\Components\TextInput::make('engine_type')->required(),
                Forms\Components\TextInput::make('transmission')->required(),
                Forms\Components\TextInput::make('body_type')->required(),
                Forms\Components\TextInput::make('plate_number')->required(),
                Forms\Components\Textarea::make('notes')->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('owner.name')->label('Owner')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('vin_number')->label('VIN'),
                Tables\Columns\TextColumn::make('make')->sortable(),
                Tables\Columns\TextColumn::make('model'),
                Tables\Columns\TextColumn::make('year'),
                Tables\Columns\TextColumn::make('plate_number')->sortable(),
                Tables\Columns\TextColumn::make('color'),
                Tables\Columns\TextColumn::make('mileage'),
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
            'index' => Pages\ListCars::route('/'),
            'create' => Pages\CreateCar::route('/create'),
            'edit' => Pages\EditCar::route('/{record}/edit'),
        ];
    }
}
