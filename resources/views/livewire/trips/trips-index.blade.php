<div x-data="{ openModal: false }" class="container mx-auto p-6 max-w-6xl">
    <!-- Page Container with Bottom Padding -->
    <div class="container mx-auto px-4 pb-20">
        
        <!-- Title -->
        <h2 class="text-3xl font-extrabold text-gray-900">{{ $driver_name }} Trip's</h2>            
        <p class="text-lg text-gray-500 mb-6">Manage and track your recent trips.</p>

        <!-- Trips List -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($trips as $trip)
                <div wire:key="{{ $trip->id }}" class="relative bg-white p-6 rounded-lg shadow-md border-l-4
                            {{ $trip->status === 'completed' ? 'border-green-500' : ($trip->status === 'ongoing' ? 'border-blue-500' : 'border-yellow-500') }}">
                    <h3 class="text-lg font-bold text-gray-900">
                        {{ $trip->from_location }} → {{ $trip->to_location }}
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">Started: <span class="font-medium">{{ $trip->started_at }}</span></p>
                    <p class="text-sm text-gray-600">Ended:
                        <span class="font-medium">{{ $trip->ended_at ?: 'Ongoing' }}</span>
                    </p>
                    <p class="text-sm font-semibold mt-2 text-gray-700">
                        Status: <span class="text-{{ $trip->status === 'completed' ? 'green' : ($trip->status === 'ongoing' ? 'blue' : 'yellow') }}-600">{{ ucfirst($trip->status) }}</span>
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 bg-white p-4 rounded-lg shadow">
            {{ $trips->links() }}
        </div>

        <!-- Add Trip Button -->
        <div class="mt-6 text-center">
            <button @click="openModal = true"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition-all duration-300">
                + Add New Trip
            </button>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Trip Form Modal -->
    <div x-show="openModal"
        class="fixed inset-0 bg-white bg-opacity-30 backdrop-blur-lg flex items-center justify-center z-50 overflow-y-auto"
        x-transition.opacity>
        
        <!-- Modal Content -->
        <div x-show="openModal" x-transition.scale.95
            class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg relative max-h-[90vh] overflow-y-auto">
            
            <!-- Modal Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-xl font-bold text-gray-800">Trip Details</h2>
                <button @click="openModal = false"
                    class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>

            <!-- Form -->
            <form class="space-y-4 mt-4" wire:submit.prevent="save">
                <div>
                    <label class="block text-gray-700 font-semibold">Car</label>
                    <select wire:model="car_id"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        <option value="">Select a car</option>
                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}</option>
                        @endforeach
                    </select>
                    @error('car_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">From Location</label>
                    <input wire:model="from_location" type="text"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('from_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">To Location</label>
                    <input wire:model="to_location" type="text"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('to_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Trip Start Time</label>
                    <input wire:model="started_at" type="datetime-local"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('started_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Trip End Time</label>
                    <input wire:model="ended_at" type="datetime-local"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('ended_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Status</label>
                    <select wire:model="status"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @foreach (\App\Enums\TripStatus::cases() as $status)
                            <option value="{{ $status->value }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold">Accident Photo</label>
                    <input type="file" wire:model="accident_photo"
                        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    @error('accident_photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 flex items-center justify-center gap-2">
                        <span>Submit Trip</span>
                        <div wire:loading wire:target="save">
                            <div class="h-5 w-5 border-t-4 border-white border-solid rounded-full animate-spin"></div>
                        </div>
                    </button>
                </div>
            </form>

            <!-- Close Button -->
            <button @click="openModal = false"
                class="mt-4 w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition-all duration-300">
                Close
            </button>
        </div>
    </div>
</div>
