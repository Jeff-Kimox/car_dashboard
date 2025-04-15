<?php

use App\Livewire\Home;
use App\Livewire\Trips;
use App\Livewire\DriverProfile;
use App\Livewire\Auth\LoginForm;
use App\Livewire\CheckList\CarCheckList;
use App\Livewire\Images\Imagesupload;
use App\Livewire\Trips\TripsIndex;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', Home::class)->name('home');
Route::get('/login', LoginForm::class)->name('login');
Route::get('/trips', TripsIndex::class)
    ->middleware('auth:driver')
    ->name('trips.index');

Route::get('/profile', DriverProfile::class)
    ->middleware('auth:driver')
    ->name('driver.profile');

Route::get('/checklist', CarCheckList::class)
    ->middleware('auth:driver')
    ->name('car.checklist');

Route::get('/images', Imagesupload::class)
    ->middleware('auth:driver')
    ->name('car.images');

// Route::middleware(['tenant'])->group(function () {
//     Filament::panel('tenant-admin')
//         ->path('{car_owner}/admin')
//          ->resources([
//             CarResource::class,
//             DriverResource::class,
//     ]);
// });
    

