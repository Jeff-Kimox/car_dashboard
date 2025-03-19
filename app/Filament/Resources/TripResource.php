<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Filament\Resources\TripResource\RelationManagers;
use App\Models\Trip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationGroup = 'Trips';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('driver_id')
                ->relationship('driver', 'name')
                ->required(),
                Forms\Components\Select::make('car_id')
                    ->relationship('car', 'plate_number')
                    ->required(),
                Forms\Components\TextInput::make('from_location')->required(),
                Forms\Components\TextInput::make('to_location')->required(),
                Forms\Components\DateTimePicker::make('trip_start_time')->required(),
                Forms\Components\DateTimePicker::make('trip_end_time'),
                Forms\Components\FileUpload::make('photo')->image()->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('driver.name')->label('Driver')->sortable(),
                Tables\Columns\TextColumn::make('car.plate_number')->label('Car')->sortable(),
                Tables\Columns\TextColumn::make('start_location'),
                Tables\Columns\TextColumn::make('end_location'),
                Tables\Columns\TextColumn::make('trip_start_time')->dateTime(),
                Tables\Columns\TextColumn::make('trip_end_time')->dateTime(),
                Tables\Columns\ImageColumn::make('photo'),
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
            'index' => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit' => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
