<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded-lg shadow">
    <h1>Trips</h1>
    <input type="text" wire:model="trip" class="border rounded p-2">

    <button wire:click="add" class="bg-indigo-500 p-2" >Add</button>

    <ul>
        @foreach ($trips as $trip)
            <li> {{ $trip }} </li>
        @endforeach
    </ul>
</div>
