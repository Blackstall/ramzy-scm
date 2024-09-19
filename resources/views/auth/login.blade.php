<x-guest-layout>
    <div class="flex flex-col md:flex-row w-full h-auto border-2 border-gray-300 rounded-lg overflow-hidden">
        <div class="flex flex-col justify-center items-center w-full md:w-1/2 p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold">Login Page</h1>
                    <p class="mt-2 text-gray-600">Login Into the System</p>
                </div>
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="block text-gray-700 text-sm font-medium" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 bg-white" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        <a class="text-sm text-indigo-600 hover:text-indigo-900" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>

                    <div class="mt-6">
                        <x-primary-button class="w-full justify-center bg-black text-white hover:bg-gray-800">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>

                    <!-- Registration Link -->
                    <div class="mt-6 text-center">
                        <span class="text-sm text-gray-600">{{ __("Don't have an account?") }}</span>
                        <a class="text-sm text-indigo-600 hover:text-indigo-900" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden md:flex md:w-1/2 items-center justify-center bg-cover bg-center">
            <img src="/asset/ramzy-logo.png" class="max-w-full max-h-full transition delay-150 duration-300 ease-in-out" alt="Logo Image" />
        </div>
    </div>
</x-guest-layout>
