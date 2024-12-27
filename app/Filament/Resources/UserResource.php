<?php

namespace App\Filament\Resources;

use App\Enums\Role;
use App\Enums\Status;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('User Info')
                    ->collapsible()
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('nid')->label('NID'),
                        TextEntry::make('phone')->label('Contact Number'),
                    ])->columns(2),

                Section::make('Vaccine Details')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->schema([
                        TextEntry::make('vaccineCenters.vaccine_center_id')
                            ->label('Center Name')
                            ->getStateUsing(function ($record) {
                                return $record->vaccineCenters->map(function ($center) {
                                    return "{$center->name}";
                                });
                            }),

                        TextEntry::make('vaccineCenters.schedule_date')
                            ->label('Schedule Date')
                            ->default('To be scheduled')
                            ->getStateUsing(function ($record) {
                                return $record->vaccineCenters->map(function ($center) {
                                    return $center->pivot->scheduled_date ?? 'To be scheduled';
                                });
                            }),

                        TextEntry::make('vaccineCenters.status')
                            ->label('Status')
                            ->getStateUsing(function ($record) {
                                return $record->vaccineCenters->map(function ($center) {
                                    return $center->pivot->status->label();
                                });
                            })
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Not Scheduled' => 'danger',
                                'Scheduled' => 'warning',
                                'Vaccinated' => 'success',
                            }),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('nid')->label('NID')->searchable()->toggleable(),
                TextColumn::make('phone')->searchable()->toggleable(),
                TextColumn::make('vaccineCenters.vaccine_center_id')
                    ->label('Center')
                    ->getStateUsing(function ($record) {
                        return $record->vaccineCenters->map(function ($center) {
                            return "{$center->name}";
                        });
                    })
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('vaccineCenters.schedule_date')
                    ->label('Schedule Date')
                    ->getStateUsing(function ($record) {
                        return $record->vaccineCenters->map(function ($center) {
                            return $center->pivot->scheduled_date ?? 'To be scheduled';
                        });
                    })
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('vaccineCenters.status')
                    ->label('Status')
                    ->getStateUsing(function ($record) {
                        return $record->vaccineCenters->map(function ($center) {
                            return $center->pivot->status->label();
                        });
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Not Scheduled' => 'danger',
                        'Scheduled' => 'warning',
                        'Vaccinated' => 'success',
                    })
                    ->toggleable(),
            ])
            ->filters([
                Filter::make('Not Schedule')
                    ->toggle()
                    ->query(function (Builder $query) {
                        $query->whereHas('vaccineCenters', function ($query) {
                            $query->where('user_vaccine_center.status', Status::NOT_SCHEDULED->value);
                        });
                    }),
                Filter::make('Schedule')
                    ->toggle()
                    ->query(function (Builder $query) {
                        $query->whereHas('vaccineCenters', function ($query) {
                            $query->where('user_vaccine_center.status', Status::SCHEDULED->value);
                        });
                    }),
                Filter::make('Vaccinated')
                    ->toggle()
                    ->query(function (Builder $query) {
                        $query->whereHas('vaccineCenters', function ($query) {
                            $query->where('user_vaccine_center.status', Status::VACCINATED->value);
                        });
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', Role::PATIENT->value);
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
            'index' => Pages\ListUsers::route('/'),
        ];
    }
}
