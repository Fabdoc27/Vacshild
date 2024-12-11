<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VaccineCenterResource\Pages;
use App\Models\VaccineCenter;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VaccineCenterResource extends Resource
{
    protected static ?string $model = VaccineCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Edit Center')
                    ->description('Change center name and daily limit')
                    ->schema([
                        TextInput::make('name')
                            ->label('Center Name')
                            ->required(),

                        TextInput::make('daily_limit')
                            ->label('Daily Limit')
                            ->numeric()
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Center Name')->sortable(),
                TextColumn::make('daily_limit')->label('Daily Limit'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListVaccineCenters::route('/'),
            'edit' => Pages\EditVaccineCenter::route('/{record}/edit'),
        ];
    }
}
