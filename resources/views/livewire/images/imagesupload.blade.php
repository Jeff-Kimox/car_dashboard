<div>
    <div x-data="{ openModal: @entangle('openModal') }" class="flex min-h-screen items-center justify-center bg-white-800">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            <!-- Gallery Item Loop -->
            @foreach($carImages as $image)
                <div class="group relative cursor-pointer items-center justify-center overflow-hidden transition-shadow hover:shadow-xl hover:shadow-black/30">
                    <div class="h-96 w-72">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:rotate-3 group-hover:scale-125" src="{{ asset('storage/' . $image->url) }}" alt="{{ $image->title }}" />
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black group-hover:from-black/70 group-hover:via-black/60 group-hover:to-black/70"></div>
                    <div class="absolute inset-0 flex translate-y-[60%] flex-col items-center justify-center px-9 text-center transition-all duration-500 group-hover:translate-y-0">
                        <h1 class="font-dmserif text-3xl font-bold text-white">{{ $image->title }}</h1>
                        <p class="mb-3 text-lg italic text-white opacity-0 transition-opacity duration-300 group-hover:opacity-100">{{ $image->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal for Image Upload -->
        <div x-show="openModal" class="fixed inset-0 bg-white bg-opacity-30 backdrop-blur-lg flex items-center justify-center z-50 overflow-y-auto" x-transition.opacity>
            <div x-show="openModal" x-transition.scale.95 class="bg-white p-6 rounded-2xl shadow-xl w-full max-w-lg relative max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center border-b pb-3">
                    <h2 class="text-xl font-bold text-gray-800">Upload New Image</h2>
                    <button @click="openModal = false" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="store" class="space-y-4 mt-4">
                    <div>
                        <label class="block text-gray-700 font-semibold">Title</label>
                        <input wire:model="title" type="text" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold">Description</label>
                        <input wire:model="description" type="text" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold">Image</label>
                        <input type="file" wire:model="image" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Upload Image</span>
                            <div wire:loading wire:target="store">
                                <div class="h-5 w-5 border-t-4 border-white border-solid rounded-full animate-spin"></div>
                            </div>
                        </button>
                    </div>
                </form>

                <button @click="openModal = false" class="mt-4 w-full bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition-all duration-300">Close</button>
            </div>
        </div>

        <!-- Add New Image Button -->
        <div class="fixed bottom-16">
            <button @click="openModal = true" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-blue-700 transition-all duration-300">
                + Add New Image
            </button>
        </div>
    </div>
</div>
