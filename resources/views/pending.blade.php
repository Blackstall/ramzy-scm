<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen py-12">
        <div class="max-w-4xl mx-auto p-6 text-center">
            <div class="flex justify-center mb-6">
                <img src="/asset/pending.png" alt="" class="w-2/5 animate-pulse">
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-2 flex items-center justify-center">
                Your status is still in pending, come back another time
            </h3>
            <p class="text-gray-600 mb-6">
             Or call our operater at (012-3456-789)
            </p>
            @if(session('package'))
                <div class="flex justify-center mt-4">
                    <a href="{{ route('packages.agreement') }}" class="bg-green-500 text-white px-6 py-3 rounded-full hover:bg-green-700 transition duration-300 flex items-center space-x-2">
                        <i class="ri-checkbox-circle-line"></i>
                        <span>{{ __('Complete Agreement') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
