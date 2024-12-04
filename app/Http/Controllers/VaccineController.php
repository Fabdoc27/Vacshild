<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Http\Requests\VaccineRegistrationRequest;
use App\Models\VaccineCenter;

class VaccineController extends Controller
{
    public function create()
    {

        $centers = VaccineCenter::all();

        return view('vaccine.create', compact('centers'));
    }

    public function store(VaccineRegistrationRequest $request)
    {
        $user = auth()->user();
        $center = VaccineCenter::findOrFail($request->vaccine_center);

        // Check if the user already registered today
        $alreadyRegistered = $user->vaccineCenters()
            ->wherePivot('scheduled_date', $request->scheduled_date)
            ->exists();

        if ($alreadyRegistered) {
            return back()->withErrors([
                'scheduled_date' => "You have already registered for vaccination on {$request->scheduled_date}. Please select another date.",
            ])->withInput();
        }

        $user->vaccineCenters()->attach(
            $center->id,
            [
                'scheduled_date' => $request->scheduled_date,
                'status' => Status::SCHEDULED->value,
            ]
        );

        $center->decrement('daily_limit');

        return to_route('dashboard')->with('message', 'You have successfully registered for vaccination.');
    }
}
