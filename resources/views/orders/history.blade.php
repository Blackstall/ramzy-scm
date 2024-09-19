<!-- resources/views/orders/history.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-700 leading-tight">
            <i class="ri-file-list-3-line mr-2"></i>
            {{ __('Purchase History') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <div class="overflow-x-auto">
            <h1 class="text-3xl font-bold mb-6 flex items-center">
                <i class="ri-history-line mr-2"></i>
                Purchase History
            </h1>

            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-hashtag mr-1"></i>No
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-money-dollar-circle-line mr-1"></i>Total Price
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-checkbox-circle-line mr-1"></i>Status
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-calendar-2-line mr-1"></i>Order Date
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-settings-2-line mr-1"></i>Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">RM {{ number_format($order->total_price, 2) }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->status }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->created_at->toFormattedDateString() }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">
                                <a href="{{ route('orders.show', $order->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 flex items-center">
                                    <i class="ri-eye-line mr-2"></i>{{ __('View') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 p-4 bg-green-100 rounded-lg text-center">
                <h3 class="text-lg font-bold text-green-700">
                    <i class="ri-coins-line mr-2"></i>Total Amount Spent: RM{{ number_format($totalSpent, 2) }}
                </h3>
            </div>
        </div>
    </div>
</x-app-layout>
