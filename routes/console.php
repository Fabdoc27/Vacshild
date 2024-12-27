<?php

use App\Jobs\MarkUsersVaccinated;
use App\Jobs\ScheduleCenters;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new ScheduleCenters)
    ->dailyAt('21:00')
    ->days([1, 2, 3, 4, 5]);

Schedule::job(new MarkUsersVaccinated)
    ->dailyAt('00:00')
    ->days([2, 3, 4, 5, 6]);
