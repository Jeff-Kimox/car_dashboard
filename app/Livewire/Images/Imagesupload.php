<?php

namespace App\Livewire\Images;

use App\Models\Carimages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Imagesupload extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $openModal = false;
    public $image;

    public function store()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image in public/images folder
        $imagePath = $this->image->store('images', 'public');
        
        // Create the image entry in the database
        Carimages::create([
            'title' => $this->title,
            'description' => $this->description,
            'url' => $imagePath,
        ]);

        // Close the modal
        $this->openModal = false;

        // Emit success message
        session()->flash('success', 'Image uploaded successfully!');
    }

    public function render()
    {
        // Directly load the images in the render method
        $carImages = Carimages::all(); 

        if ($carImages->isEmpty()) {
            $carImages = collect();  
        }

        return view('livewire.images.imagesupload', [
            'carImages' => $carImages,
        ]);
    }
}
