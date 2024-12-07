<?php

use App\Jobs\MarkUsersVaccinated;
use App\Jobs\ScheduleVaccination;

Schedule::job(new ScheduleVaccination)
    ->dailyAt('21:00')
    ->days([1, 2, 3, 4, 5]);

Schedule::job(new MarkUsersVaccinated)
    ->dailyAt('00:00')
    ->days([2, 3, 4, 5, 6]);
