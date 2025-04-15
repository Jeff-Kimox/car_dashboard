<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class LogoutButton extends Component
{

    public function logout()
    {
        if (Auth::guard('driver')->check()) {
            Auth::guard('driver')->logout();
        } else {
            Auth::logout();
        }

        request()->session()->invalidate();
        request()->session()->regenerateToken();


        return $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        return view('livewire.logout-button');
    }
}
