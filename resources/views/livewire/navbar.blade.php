
<div>
    <header class="mb-2 px-4 shadow"> 
        <div class="relative mx-auto flex max-w-screen-lg flex-col py-4 sm:flex-row sm:items-center sm:justify-between">
            <a href="{{ route('home') }}" class="flex items-center text-2xl font-black" wire:navigate >
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto" />
            </a>
    
            <input class="peer hidden" type="checkbox" id="navbar-open" />
            <label class="absolute right-0 mt-1 cursor-pointer text-xl sm:hidden" for="navbar-open">
                <span class="sr-only">Toggle Navigation</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="0.88em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 448 512"><path fill="currentColor" d="M0 96c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm0 160c0-17.7 14.3-32 32-32h384c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zm448 160c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h384c17.7 0 32 14.3 32 32z" /></svg>
            </label>
    
            <nav aria-label="Header Navigation" class="peer-checked:block hidden pl-2 py-6 sm:block sm:py-0">
                <ul class="flex flex-col gap-y-4 sm:flex-row sm:gap-x-8">
                    <li><a class="text-gray-600 hover:text-blue-600" href="{{ route('trips.index') }}" wire:navigate>Trips</a></li>
                    <li><a class="text-gray-600 hover:text-blue-600" href="{{ route('car.checklist') }}" wire:navigate>Checklist</a></li>
                    <li><a class="text-gray-600 hover:text-blue-600" href="{{ route('car.images') }}" wire:navigate>Images</a></li>
            
                    @if(Auth::guard('driver')->check())
                        <!-- Logged-in driver: Show dropdown -->
                        <li class="relative" x-data="{ open: false }">
                            <!-- Button to toggle dropdown -->
                            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('driver')->user()->name) }}&background=random"
                                     alt="Profile" class="w-8 h-8 rounded-full">
                                <span class="text-gray-700 font-medium">{{ Auth::guard('driver')->user()->name }}</span>
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
            
                            <!-- Dropdown menu -->
                            <ul x-show="open" @click.away="open = false"
                                class="absolute left-0 mt-2 w-48 bg-white shadow-md rounded-lg">
                                <li><a href="{{ route('driver.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a></li>
                                <li>
                                    <livewire:logout-button /> 
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- Not logged in: Show login button -->
                        <li class="mt-2 sm:mt-0">
                            <a class="rounded-xl border-2 border-blue-600 px-6 py-2 font-medium text-blue-600 hover:bg-blue-600 hover:text-white"
                               href="{{ route('login') }}" wire:navigate >
                                Login
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            
        </div>
    </header>
    
    <!-- Bottom Navigation Bar -->
    <div class="fixed bottom-0 left-0 w-full bg-[#00ADF2] shadow-md sm:hidden z-50">
        <nav class="flex justify-around py-2">
            <a href="{{ route('home') }}" class="flex flex-col items-center text-white hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-2 2V21H5V12z"/>
                </svg>
                <span class="text-xs">Home</span>
            </a>
            <a href="{{ route('trips.index') }}" class="flex flex-col items-center text-white hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16"/>
                </svg>
                <span class="text-xs">Trips</span>
            </a>
            <a href="{{ route('car.checklist') }}" class="flex flex-col items-center text-white hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="text-xs">Checklist</span>
            </a>
            <a href="{{ route('car.images') }}" class="flex flex-col items-center text-white hover:text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m0-12a9 9 0 11-6 0"/>
                </svg>
                <span class="text-xs">Images</span>
            </a>
    
            @if(Auth::guard('driver')->check())
                <a href="{{ route('driver.profile') }}" class="flex flex-col items-center text-white hover:text-blue-600">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('driver')->user()->name) }}&background=random"
                        alt="Profile" class="w-6 h-6 rounded-full">
                    <span class="text-xs">Profile</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="flex flex-col items-center text-white hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m12 0l-4-4m4 4l-4 4"/>
                    </svg>
                    <span class="text-xs">Login</span>
                </a>
            @endif
        </nav>
    </div>
</div>