<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Script AJAX --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="relative min-h-screen flex" x-data="{ open: true }">
        <!-- sidebar -->
        <aside :class="{'translate-x-0': open, '-translate-x-full': !open}" class="fixed z-10 bg-red-800 text-red-100 w-64 px-2 py-4 inset-y-0 left-0 
        transform transition-transform duration-200 ease-in-out md:relative md:translate-x-0"> 

            <!-- Logo -->
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center space-x-2">
                    <a href="">
                        <x-application-logo class="block h-9 w-auto fill-current text-red-100" />
                    </a>
                    <span class="text-2xl font-extrabold">Franchisee</span>
                </div>
                <button type="button" @click="open = false" class="inline-flex p-2 items-center justify-center rounded-md text-red-100 hover:bg-red-700
                focus:outline-none md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>  
                </button>
            </div>

            <!-- Nav Links -->
            <nav class="pt-5">
                <x-side-nav-fr href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')">
                    <i class="ri-dashboard-line mr-2"></i> Dashboard
                </x-side-nav-fr> 

                <x-side-nav-fr href="{{ route('orders.create') }}" :active="request()->routeIs('orders.create')"> 
                    <i class="ri-shopping-cart-line mr-2"></i> Purchase Order
                </x-side-nav-fr> 

                <x-side-nav-fr href="{{ route('orders.status') }}" :active="request()->routeIs('orders.status')">
                    <i class="ri-file-list-2-line mr-2"></i> Status Order
                </x-side-nav-fr> 

                <x-side-nav-fr href="{{ route('orders.history') }}" :active="request()->routeIs('orders.history')">
                    <i class="ri-history-line mr-2"></i> History
                </x-side-nav-fr> 
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col transition-all duration-200">
            <nav class="bg-red-900 shadow-lg">
                <div class="mx-auto px-2 sm:px-6 lg:px-8">
                    <div class="relative flex items-center justify-between h-16">
                        <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                            <button type="button" @click="open = !open" class="inline-flex items-center justify-center
                            p-2 rounded-md text-red-100 hover:bg-red-700 focus:outline-none">
                                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="block h-6 w-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex flex-1 items-center justify-center">
                            <div class="flex flex-shrink-0 items-center">
                                <a href="{{ route('dashboard') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-red-100" />
                                </a>
                            </div>
                        </div>

                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-red-100 hover:bg-red-700 
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

            <main class="flex-1 bg-gray-100 p-6">
                <!-- Main content goes here -->
                <div>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script>
        function calculateTotalPrice(element) {
            const quantity = parseFloat(element.value) || 0;
            const price = parseFloat(element.getAttribute('data-price')) || 0;
            const totalPriceElement = element.closest('.border').querySelector('.total-price');
            if (totalPriceElement) {
                const totalPrice = (quantity * price).toFixed(2);
                totalPriceElement.innerText = totalPrice;
                console.log(`Calculated total price for element: ${totalPrice}`);  // Logging for debugging
            } else {
                console.error('Total price element not found');  // Error logging
            }

            calculateOverallPrice();
        }

        function calculateOverallPrice() {
            let overallPrice = 0;
            document.querySelectorAll('.total-price').forEach(element => {
                overallPrice += parseFloat(element.innerText) || 0;
            });
            const overallPriceElement = document.getElementById('overall-price');
            if (overallPriceElement) {
                overallPriceElement.innerText = overallPrice.toFixed(2);
                console.log(`Calculated overall price: ${overallPrice}`);  // Logging for debugging
            } else {
                console.error('Overall price element not found');  // Error logging
            }
        }

        function confirmOrder() {
            let confirmMessage = 'Are you sure you want to place this order?';
            if (confirm(confirmMessage)) {
                document.getElementById('orderForm').submit();
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('input', function() {
                    calculateTotalPrice(this);
                });
            });
            calculateOverallPrice();
        });
    </script>
</body>
</html>
