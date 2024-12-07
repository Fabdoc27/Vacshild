<?php

namespace App\Http\Controllers;

use App\Models\VaccineCenter;
use Illuminate\Http\Request;

class VaccineController extends Controller
{
    public function create()
    {
        $centers = VaccineCenter::orderBy('name')->get();

        return view('vaccine.create', compact('centers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vaccine_center' => ['required', 'exists:vaccine_centers,id'],
        ]);

        $user = auth()->user();
        $centerId = $validated['vaccine_center'];

        $user->vaccineCenters()->attach($centerId);

        return to_route('dashboard')->with('message', 'You have successfully registered for vaccination.');
    }
}
