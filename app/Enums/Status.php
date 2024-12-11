<?php

namespace App\Enums;

enum Status: string
{
    case NOT_SCHEDULED = 'not_scheduled';
    case SCHEDULED = 'scheduled';
    case VACCINATED = 'vaccinated';

    public function label(): string
    {
        return match ($this) {
            self::NOT_SCHEDULED => 'Not Scheduled',
            self::SCHEDULED => 'Scheduled',
            self::VACCINATED => 'Vaccinated',
        };
    }
}
