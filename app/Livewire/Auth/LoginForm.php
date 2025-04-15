<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginForm extends Component
{

    public $email = '';
    public $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
        //     return redirect()->intended('/');
        // }
        if (Auth::guard('driver')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->intended('/');
        }

        $this->addError('email', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }

    // public function render()
    // {
    //     return view('livewire.auth.login-form')
    //     ->layout('layouts.app', ['title' => 'Login']);
    // }
}
