<div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div>
                <img src="{{ asset('assets/images/logo.png') }}"
                    class="w-50 mx-auto" />
            </div>

            <div class="mt-12 flex flex-col items-center">
                <h1 class="text-2xl xl:text-3xl font-extrabold">
                    Login
                </h1>

                <div class="w-full flex-1 mt-8">
                    <div class="mx-auto max-w-md bg-white p-8 rounded-lg shadow">
                        <form wire:submit.prevent="login">
                            <div class="mb-4">
                                <label class="block mb-1 text-gray-700">Email</label>
                                <input type="email" wire:model.defer="email" class="w-full border rounded p-2">
                                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1 text-gray-700">Password</label>
                                <input type="password" wire:model.defer="password" class="w-full border rounded p-2">
                                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-indigo-500 text-white py-2 rounded hover:bg-indigo-700 transition">
                                Login
                            </button>
                        </form>

                        <p class="mt-4 text-center">
                            Don't have an account?
                            <a href="/register" class="text-blue-600 hover:underline">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Image -->
        <div class="flex-1 bg-indigo-100 text-center hidden lg:flex">
            {{-- <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
                style="background-image: url('https://storage.googleapis.com/devitary-image-host.appspot.com/15848031292911696601-undraw_designer_life_w96d.svg');">
            </div> --}}
            <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat">
                <img src="{{ asset('assets/images/lgn.svg') }}" />
            </div>
        </div>
    </div>
</div>
