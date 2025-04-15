<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarChecklistResource\Pages;
use App\Filament\Resources\CarChecklistResource\RelationManagers;
use App\Models\CarChecklist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarChecklistResource extends Resource
{
    protected static ?string $model = CarChecklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Car Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('car_id')
                    ->relationship('car', 'plate_number')
                    ->required(),
                Forms\Components\TextInput::make('mileage')->required(),
                Forms\Components\DateTimePicker::make('checked_at')->required(),
                Forms\Components\Checkbox::make('tires_checked')->required(),
                Forms\Components\Checkbox::make('oil_level_checked')->required(),
                Forms\Components\Checkbox::make('lights_checked')->required(),
                Forms\Components\Checkbox::make('brakes_checked')->required(),
                Forms\Components\Textarea::make('notes')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('car.plate_number')->label('Car')->sortable(),
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
            'index' => Pages\ListCarChecklists::route('/'),
            'create' => Pages\CreateCarChecklist::route('/create'),
            'edit' => Pages\EditCarChecklist::route('/{record}/edit'),
        ];
    }
}
