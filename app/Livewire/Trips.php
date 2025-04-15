<?php

namespace App\Livewire;

use Livewire\Component;

class Trips extends Component
{
    public $trips = [];

    public $trip = '';

    public function mount()
    {
        $this->trips = ['trip one', 'trip two'];
    }

    public function add()
    {
        $this->trips[] = $this->trip;

        $this->trip = '';

    }

    public function render()
    {
        return view('livewire.trips');
    }
}
