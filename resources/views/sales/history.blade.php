<!-- resources/views/sales/history.blade.php -->

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales History') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            <h2 class="text-4xl font-extrabold text-blue-700 my-8 flex items-center">
                <i class="ri-history-line mr-2"></i>
                Sales History
            </h2>

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-white">&times;</button>
                </div>
            @endif

            <div class="flex items-center justify-between bg-blue-500 p-4 rounded-t-lg">
                <h2 class="text-white text-lg font-bold">List of Past Orders</h2>
            </div>
            <div class="bg-white shadow-md rounded-b-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-hashtag"></i>No
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-user-line"></i> Franchisee
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-money-dollar-circle-line"></i> Total Price
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-information-line"></i> Status
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-calendar-line"></i> Completed Date
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-tools-line"></i> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($completedOrders as $index => $order)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="py-2 px-4 text-sm text-gray-700">{{ $completedOrders->firstItem() + $index }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700">{{ $order->user->name }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700">RM {{ $order->total_price }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700">{{ $order->status }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700">
                                        {{ $order->completed_date ? $order->completed_date->toFormattedDateString() : 'N/A' }}
                                    </td>
                                    <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                                        <a href="{{ route('sales-orders.show', $order->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 flex items-center space-x-1">
                                            <i class="ri-eye-line"></i>
                                            <span>{{ __('View') }}</span>
                                        </a>
                                        <form action="{{ route('sales-orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center space-x-1">
                                                <i class="ri-delete-bin-6-line"></i>
                                                <span>{{ __('Delete') }}</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $completedOrders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
