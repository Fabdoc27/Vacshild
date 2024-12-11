<?php

namespace App\Filament\Widgets;

use App\Enums\Role;
use App\Enums\Status;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Models\VaccineRegistration;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected static bool $isLazy = false;

    protected function getStats(): array
    {
        return [
            Stat::make('Vaccine Centers', VaccineCenter::count())
                ->description('Currently Operable Centers'),

            Stat::make('Users', User::where('role', Role::PATIENT)->count())
                ->description('Total Registered Users'),

            Stat::make('Total Vaccinated', VaccineRegistration::where('status', Status::VACCINATED)->count())
                ->description('Users got Vaccinated'),
        ];
    }
}
