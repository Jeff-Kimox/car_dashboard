<?php

namespace App\Livewire\CheckList;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Carbon;
use App\Models\Car;
use App\Models\CarChecklistEntry;
use Livewire\Features\SupportBrowserEvents\DispatchesBrowserEvents; 


class CarCheckList extends Component
{

    public $car_id;
    public $mileage;
    public $checked_at;
    public $tires_checked = false;
    public $oil_level_checked = false;
    public $lights_checked = false;
    public $brakes_checked = false;
    public $notes;

    public $cars;

    public function mount()
    {
        $this->cars = Car::all();
        $this->checked_at = now()->format('Y-m-d\TH:i'); 
    }



    public function save()
    {
        // Validation
        $this->validate([
            'car_id' => 'required|exists:cars,id',
            'mileage' => 'required|numeric',
            'checked_at' => 'required|date',
            'tires_checked' => 'nullable|boolean',
            'oil_level_checked' => 'nullable|boolean',
            'lights_checked' => 'nullable|boolean',
            'brakes_checked' => 'nullable|boolean',
            'notes' => 'nullable|string',
        ]);

        // Create the checklist record
        CarChecklistEntry::create([
            'car_id' => $this->car_id,
            'mileage' => $this->mileage,
            'checked_at' => $this->checked_at,
            'tires_checked' => $this->tires_checked,
            'oil_level_checked' => $this->oil_level_checked,
            'lights_checked' => $this->lights_checked,
            'brakes_checked' => $this->brakes_checked,
            'notes' => $this->notes,
        ]);

        // Show a success message
        session()->flash('message', 'Car checklist saved successfully!');
        $this->reset();  // Optionally reset form fields
    }




    // public function render()
    // {
    //     $driver = Auth::guard('driver')->user();
    //     $checklists = CarChecklistEntry::where('car_id', $this->car_id)->latest()->paginate(6);;
    //     $cars = Car::all();


    //     return view('livewire.check-list.car-check-list',
    //         [
    //             'checklists' => $checklists,
    //             'cars' => $cars,
    //             'driver_name' => Auth::guard('driver')->user()->name,
    //         ]
    //     );
    // }

    public function render()
    {
        // Fetch checklists: filter by car_id if selected, otherwise get all checklists
        if ($this->car_id) {
            $checklists = CarChecklistEntry::where('car_id', $this->car_id)->latest()->paginate(6);
        } else {
            $checklists = CarChecklistEntry::latest()->paginate(6);
        }

        $cars = Car::all();

        return view('livewire.check-list.car-check-list', [
            'checklists' => $checklists,
            'cars' => $cars,
            'driver_name' => Auth::guard('driver')->user()->name,
        ]);
    }





    
}
