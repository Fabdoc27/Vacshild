<?php

namespace App\Enums;

enum Status: string {
    case NOT_SCHEDULED = 'not_scheduled';
    case SCHEDULED = 'scheduled';
    case VACCINATED = 'Vaccinated';
}