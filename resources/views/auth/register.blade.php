<x-guest-layout>
    <div class="flex flex-col md:flex-row w-full h-auto border-2 border-gray-300 rounded-lg overflow-hidden">
        <div class="flex flex-col justify-center items-center w-full md:w-1/2 p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold">Register</h1>
                    <p class="mt-2 text-gray-600">Create an account to register into the system now</p>
                </div>
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 bg-white" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <x-input-label for="phone" :value="__('Phone Number')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="phone" class="block mt-1 w-full border-gray-300 bg-white" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div>
                        <x-input-label for="address" :value="__('Address')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="address" class="block mt-1 w-full border-gray-300 bg-white" type="text" name="address" :value="old('address')" required autocomplete="address" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 bg-white" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 bg-white" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ml-4 bg-black text-white hover:bg-gray-800">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden md:flex md:w-1/2 items-center justify-center bg-cover bg-center">
            <img src="/asset/ramzy-logo.png" class="max-w-full max-h-full animate-bounce" alt="Logo Image" />
        </div>
    </div>
</x-guest-layout>
