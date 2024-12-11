<?php

namespace App\Filament\Auth;

use Filament\Pages\Auth\Login;

class LoginValues extends Login
{
    public function mount(): void
    {
        parent::mount();

        $this->form->fill([
            'email' => 'admin@test.com',
            'password' => 'password',
            'remember' => true,
        ]);
    }
}
