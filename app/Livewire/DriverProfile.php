<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DriverProfile extends Component
{
    public $driver;

    public function mount()
    {
        // Check if the driver is authenticated using the 'driver' guard
        $driverId = Auth::guard('driver')->id();

        if (!$driverId) {
            abort(403, 'Unauthorized access');
        }

        // Retrieve the authenticated driver
        $this->driver = Auth::guard('driver')->user();
    }

    // public function updateProfile()
    // {
    //     $this->validate([
    //         'driver.name' => 'required|string|max:255',
    //         'driver.email' => 'required|email|max:255',
    //         'driver.phone' => 'required|string|max:15',
            
    //     ]);

    //     $this->driver->save();

    //     session()->flash('message', 'Profile updated successfully.');
    // }

    // public function updatePassword()
    // {
    //     $this->validate([
    //         'current_password' => 'required|string',
    //         'new_password' => 'required|string|min:8|confirmed',
    //     ]);

    //     if (!password_verify($this->current_password, Auth::guard('driver')->user()->password)) {
    //         session()->flash('error', 'Current password is incorrect.');
    //         return;
    //     }

    //     Auth::guard('driver')->user()->update([
    //         'password' => bcrypt($this->new_password),
    //     ]);

    //     session()->flash('message', 'Password updated successfully.');
    // }

    // public function deleteAccount()
    // {
    //     $this->validate([
    //         'password' => 'required|string',
    //     ]);

    //     if (!password_verify($this->password, Auth::guard('driver')->user()->password)) {
    //         session()->flash('error', 'Password is incorrect.');
    //         return;
    //     }

    //     Auth::guard('driver')->user()->delete();

    //     session()->flash('message', 'Account deleted successfully.');
    // }

    public function render()
    {
        return view('livewire.driver-profile');
    }
}
