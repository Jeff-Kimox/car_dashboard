<div>
    <div class="max-w-2xl mx-4 sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900">
        <!-- Cover Image -->
        <div class="rounded-t-lg h-32 overflow-hidden">
            <img class="object-cover object-top w-full"
                src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ"
                alt="Cover Image">
        </div>
    
        <!-- Profile Image -->
        <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
            <img class="object-cover object-center h-32" src="https://ui-avatars.com/api/?name={{ urlencode($driver->name) }}&background=random"
                alt="{{ $driver->name }}">
        </div>
    
        <!-- Driver Details -->
        <div class="text-center mt-2">
            <h2 class="font-semibold">{{ $driver->name }}</h2>
            <p class="text-gray-500">{{ $driver->email }}</p>
        </div>
    
        <!-- Ratings -->
        <div class="flex items-center justify-center mt-3">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= round($driver->rating))
                    <svg class="w-6 h-6 text-yellow-500 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                    </svg>
                @else
                    <svg class="w-6 h-6 text-gray-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                    </svg>
                @endif
            @endfor
        </div>
    
        <!-- Profile Stats -->
        <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around">
            <li class="flex flex-col items-center">
                <span class="font-bold text-lg">{{ $driver->trips->count() }}</span>
                <span class="text-xs text-gray-500">Trips</span>
            </li>
            <li class="flex flex-col items-center">
                <span class="font-bold text-lg">{{ round($driver->rating, 1) }}/5</span>
                <span class="text-xs text-gray-500">Rating</span>
            </li>
        </ul>
    
        <!-- Actions -->
        <div class="p-4 border-t mx-8 mt-2">
            <button wire:click="logout"
                class="w-full block mx-auto rounded-full bg-red-500 hover:bg-red-700 font-semibold text-white px-6 py-2">
                Logout
            </button>
        </div>
    </div>
    
</div>
