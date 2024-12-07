<?php

namespace App\Jobs;

use App\Enums\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MarkUsersVaccinated implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $date = Carbon::yesterday()->toDateString();

        User::whereHas('vaccineCenters', function ($query) use ($date) {
            $query->wherePivot('status', Status::SCHEDULED)
                ->wherePivot('scheduled_date', $date);
        })->get()->each(function ($user) {
            $user->pivot->update([
                'status' => Status::VACCINATED,
            ]);
        });
    }
}
