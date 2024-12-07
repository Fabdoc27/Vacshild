<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique(User::class, 'email')],
            'nid' => ['required', 'numeric', Rule::unique(User::class, 'nid')],
            'phone' => ['required', 'string', Rule::unique(User::class, 'phone')],
            'password' => ['required', 'confirmed', Password::min('6')],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nid' => $request->nid,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('vaccine.create'))->with('message', 'Resister Successfully');
    }
}
