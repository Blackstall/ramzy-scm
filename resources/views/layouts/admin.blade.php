<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Script AJAX --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased">
    <div class="relative min-h-screen flex" x-data="{ open: true }">
        {{-- sidebar --}}
        <aside :class="{'translate-x-0': open, '-translate-x-full': !open}" class="fixed z-10 bg-blue-800 text-blue-100 w-64 px-2 py-4 inset-y-0 left-0 
        transform transition-transform duration-200 ease-in-out md:relative md:translate-x-0"> 

            {{-- Logo --}}
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center space-x-2">
                    <a href="">
                        <x-application-logo class="block h-9 w-auto fill-current text-blue-100" />
                    </a>
                    <span class="text-2xl font-extrabold">Franchisor</span>
                </div>
                <button type="button" @click="open = false" class="inline-flex p-2 items-center justify-center rounded-md text-blue-100 hover:bg-blue-700
                focus:outline-none md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>  
                </button>
            </div>

            {{-- Nav Links --}}
            <nav class="pt-5">
                <x-side-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                    <i class="ri-shapes-line mr-2"></i>
                    Dashboard
                </x-side-nav-link> 

                <x-side-nav-link href="{{ route('validation') }}" :active="request()->routeIs('validation')"> 
                    <i class="ri-shake-hands-line mr-2"></i>
                    Franchisee Status
                </x-side-nav-link> 

                <x-side-nav-link href="{{ route('sales-orders.index') }}" :active="request()->routeIs('sales-orders.index')">
                    <i class="ri-briefcase-line mr-2"></i>
                    Sales Order
                </x-side-nav-link> 

                <x-side-nav-link href="{{ route('sales-history') }}" :active="request()->routeIs('sales-history')">
                    <i class="ri-history-line mr-2"></i>
                    Sales History
                </x-side-nav-link> 

                <x-side-nav-link href="{{ route('sales-report') }}" :active="request()->routeIs('sales-report')">
                    <i class="ri-funds-line mr-2"></i>
                    Sales Report
                </x-side-nav-link> 

                <x-side-nav-link href="{{ route('inventory.index') }}" :active="request()->routeIs('inventory.index')">
                    <i class="ri-archive-fill mr-2"></i>
                    Inventory
                </x-side-nav-link> 
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col transition-all duration-200">
            <nav class="bg-blue-900 shadow-lg">
                <div class="mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                            <button type="button" @click="open = !open" class="inline-flex items-center justify-center
                            p-2 rounded-md text-blue-100 hover:bg-blue-700 focus:outline-none">
                                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex flex-1 items-center justify-center">
                            <a href="{{ route('admin.dashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-blue-100" />
                            </a>
                        </div>

                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-blue-100 hover:bg-blue-700 
                                    p-2 rounded-md focus:outline-none transition ease-in-out duration-200">
                                        <div>{{ Auth::user()->name }}</div>
            
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
            
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
            
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
            
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>                         
                    </div>
                </div>
            </nav>

            <main class="flex-1 bg-gray-100 p-1">
                <!-- Main content goes here -->
                <div>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>
