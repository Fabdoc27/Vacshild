<?php

namespace App\Jobs;

use App\Models\VaccineCenter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ScheduleCenters implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $centers = VaccineCenter::all();

        foreach ($centers as $center) {
            dispatch(new ScheduleVaccination($center));
        }
    }
}
