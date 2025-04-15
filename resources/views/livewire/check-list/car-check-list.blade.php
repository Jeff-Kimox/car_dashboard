<div>
    <div x-data="{ openModal: false }" class="container mx-auto p-6 max-w-6xl">
        <!-- Page Container with Bottom Padding -->
        <div class="container mx-auto px-4 pb-20">
            
            <!-- Title -->
            <p class="text-lg text-gray-500 mb-6">Manage and track your recent car checklists.</p>
    
            <!-- Checklist List -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($checklists as $checklist)
                    <div wire:key="{{ $checklist->id }}" class="relative bg-white p-6 rounded-lg shadow-md border-l-4
                                 {{ $checklist->tires_checked && $checklist->oil_level_checked && $checklist->lights_checked && $checklist->brakes_checked ? 'border-green-500' : 'border-yellow-500' }}">
                        <h3 class="text-lg font-bold text-gray-900">
                            Checklist for {{ $checklist->car->make }} {{ $checklist->car->model }}
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Mileage: <span class="font-medium">{{ $checklist->mileage }}</span> km</p>
                        <p class="text-sm text-gray-600">Checked At: <span class="font-medium">{{ $checklist->checked_at }}</span></p>
                        <p class="text-sm font-semibold mt-2 text-gray-700">
                            Status: 
                            <span class="text-{{ $checklist->tires_checked && $checklist->oil_level_checked && $checklist->lights_checked && $checklist->brakes_checked ? 'green' : 'yellow' }}-600">
                                {{ $checklist->tires_checked && $checklist->oil_level_checked && $checklist->lights_checked && $checklist->brakes_checked ? 'Completed' : 'Incomplete' }}
                            </span>
                        </p>
                        {{-- <div class="mt-4">
                            <button @click="openModal = true" wire:click="editChecklist({{ $checklist->id }})"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition-all duration-300">
                                Edit Checklist
                            </button>
                        </div> --}}
                    </div>
                @empty
                    <p class="text-gray-500">No checklists found.</p>
                @endforelse
            </div>
            
    
            <!-- Pagination -->
            <div class="mt-8 bg-white p-4 rounded-lg shadow">
                {{ $checklists->links() }}
            </div>
    
            <!-- Add Checklist Button -->
            <div class="mt-6 text-center">
                <button @click="openModal = true"
                    class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition-all duration-300">
                    + Add New Checklist
                </button>
            </div>
        </div>
        <!-- End of Container -->
    
        <!-- Checklist Form Modal -->
        <div x-show="openModal"
            class="fixed inset-0 bg-white bg-opacity-30 backdrop-blur-lg flex items-center justify-center z-50 overflow-y-auto"
            x-transition.opacity>
            
            <!-- Modal Content -->
            <div x-show="openModal" x-transition.scale.95
                class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg relative max-h-[90vh] overflow-y-auto">
                
                <!-- Modal Header -->
                <div class="flex justify-between items-center border-b pb-3">
                    <h2 class="text-xl font-bold text-gray-800">{{ isset($checklist) ? 'Edit Checklist' : 'Add Checklist' }}</h2>
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
                        <label class="block text-gray-700 font-semibold">Mileage</label>
                        <input wire:model="mileage" type="number"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @error('mileage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold">Checked At</label>
                        <input wire:model="checked_at" type="datetime-local"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @error('checked_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold">Tires Checked</label>
                        <input wire:model="tires_checked" type="checkbox"
                            class="focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold">Oil Level Checked</label>
                        <input wire:model="oil_level_checked" type="checkbox"
                            class="focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold">Lights Checked</label>
                        <input wire:model="lights_checked" type="checkbox"
                            class="focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold">Brakes Checked</label>
                        <input wire:model="brakes_checked" type="checkbox"
                            class="focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    </div>
    
                    <div>
                        <label class="block text-gray-700 font-semibold">Notes</label>
                        <textarea wire:model="notes" rows="4"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none"></textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Submit Checklist</span>
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
</div>