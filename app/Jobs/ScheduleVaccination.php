<?php

namespace App\Jobs;

use App\Enums\Status;
use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ScheduleVaccination implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $centers = VaccineCenter::all();

        foreach ($centers as $center) {
            $users = $center->users()
                ->wherePivot('status', 'not_scheduled')
                ->orderBy('user_vaccine_center.created_at')
                ->take($center->daily_limit)
                ->get();

            foreach ($users as $user) {
                $scheduledDate = Carbon::now()->addDay()->toDateString();

                $user->pivot->update([
                    'status' => Status::SCHEDULED,
                    'scheduled_date' => $scheduledDate,
                ]);

                dispatch(new NotifyUserScheduled($user, $scheduledDate));
            }
        }
    }
}
