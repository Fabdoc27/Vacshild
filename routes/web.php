<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VaccineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    $vaccineRecords = $user->vaccineCenters()
        ->withPivot('scheduled_date', 'status')
        ->paginate(15);

    return view('dashboard', compact('vaccineRecords'));
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/vaccine/register', [VaccineController::class, 'create'])->name('vaccine.create');
    Route::post('/vaccine/register', [VaccineController::class, 'store'])->name('vaccine.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
