<!-- resources/views/sales/report.blade.php -->

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales Report') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            <h2 class="text-4xl font-extrabold text-blue-700 my-8 flex items-center">
                <i class="ri-funds-line mr-2"></i>
                Performance Report
            </h2>

            <form action="{{ route('sales-report') }}" method="GET" class="mb-6 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="ri-calendar-line mr-2"></i> Filter by Date Range
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label for="start_date" class="block font-medium text-sm text-gray-700">{{ __('Start Date') }}</label>
                        <input id="start_date" type="date" name="start_date" value="{{ $startDate }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label for="end_date" class="block font-medium text-sm text-gray-700">{{ __('End Date') }}</label>
                        <input id="end_date" type="date" name="end_date" value="{{ $endDate }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 flex items-center justify-center space-x-2">
                        <i class="ri-refresh-line"></i>
                        <span>{{ __('Update') }}</span>
                    </button>
                </div>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-6 shadow rounded-lg">
                    <h3 class="text-lg font-medium flex items-center">
                        <i class="ri-bar-chart-line mr-2"></i> Daily Profits
                    </h3>
                    <ul class="mt-4">
                        @foreach ($dailyProfits as $date => $profit)
                            <li class="flex justify-between py-2 border-b border-blue-200">
                                <span>{{ $date }}</span>
                                <span>{{ number_format($profit, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-6 shadow rounded-lg">
                    <h3 class="text-lg font-medium flex items-center">
                        <i class="ri-calendar-todo-line mr-2"></i> Monthly Profits
                    </h3>
                    <ul class="mt-4">
                        @foreach ($monthlyProfits as $date => $profit)
                            <li class="flex justify-between py-2 border-b border-green-200">
                                <span>{{ $date }}</span>
                                <span>{{ number_format($profit, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-6 shadow rounded-lg">
                    <h3 class="text-lg font-medium flex items-center">
                        <i class="ri-calendar-event-line mr-2"></i> Yearly Profits
                    </h3>
                    <ul class="mt-4">
                        @foreach ($yearlyProfits as $date => $profit)
                            <li class="flex justify-between py-2 border-b border-yellow-200">
                                <span>{{ $date }}</span>
                                <span>{{ number_format($profit, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
