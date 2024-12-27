<?php

namespace App\Jobs;

use App\Enums\Status;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

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

        DB::table('user_vaccine_center')
            ->where('status', Status::SCHEDULED)
            ->where('scheduled_date', $date)
            ->update(['status' => Status::VACCINATED]);
    }
}
