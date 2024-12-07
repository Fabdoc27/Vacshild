<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Relations\Pivot;

class VaccineRegistration extends Pivot
{
    protected $table = 'user_vaccine_center';

    protected $casts = [
        'status' => Status::class,
    ];
}
