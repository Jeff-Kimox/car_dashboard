<?php

namespace App\Livewire\Trips;

use App\Models\Car;
use App\Models\Trip;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate; 
use App\Enums\TripStatus;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;


class TripsIndex extends Component
{
    use WithFileUploads, WithPagination;

    public $driver_id;
    public $car_id;
    public $from_location;
    public $to_location;
    public $started_at;
    public $ended_at;
    public $status;
    public $accident_photo;


    public function mount()
    {
        if (! Auth::guard('driver')->check()) {
            return redirect()->route('login');
        }

        $this->driver_id = Auth::guard('driver')->id();
    }


    public function save()
    {
        $this->validate([
            'driver_id' => 'required|exists:drivers,id',
            'car_id' => 'required|exists:cars,id',
            'from_location' => 'required|string|max:255',
            'to_location' => 'required|string|max:255',
            'started_at' => 'required|date',
            'ended_at' => 'nullable|date|after:started_at',
            'status' => 'required|in:' . implode(',', array_column(TripStatus::cases(), 'value')),
            'accident_photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

       

        $data = $this->only([
            'driver_id',
            'car_id',
            'from_location',
            'to_location',
            'started_at',
            'ended_at',
            'status',
        ]);

    
        if ($this->accident_photo) {
            $data['accident_photo_path'] = $this->accident_photo->store('accident-photos', 'public');
        }
    
        Trip::create($data);
    
        session()->flash('message', 'Trip created successfully!');
        $this->reset();
    }
    
    public function render()
    {
        $driver = Auth::guard('driver')->user();
        $trips = $driver->trips()->latest()->paginate(6);
        $cars = Car::all();


        return view('livewire.trips.trips-index',
            [
                'trips' => $trips,
                'cars' => $cars,
                'tripStatuses' => TripStatus::cases(),
                'driver_name' => Auth::guard('driver')->user()->name,
            ]
        );
    }
}
