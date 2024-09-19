<!-- resources/views/orders/show.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-700 leading-tight">
            <i class="ri-eye-line mr-2"></i>
            {{ __('Order Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-3xl font-bold mb-6 flex items-center">
                <i class="ri-file-list-3-line mr-2"></i>
                Order #{{ $order->id }}
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Order ID:</h3>
                    <p class="text-gray-600">{{ $order->id }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Price:</h3>
                    <p class="text-gray-600">RM {{ number_format($order->total_price, 2) }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Status:</h3>
                    <p class="text-gray-600">{{ $order->status }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Order Date:</h3>
                    <p class="text-gray-600">{{ $order->created_at->toFormattedDateString() }}</p>
                </div>
            </div>

            <h3 class="text-xl font-bold mt-8 mb-4">Order Items</h3>
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-hashtag mr-1"></i>No
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-shopping-cart-line mr-1"></i>Item
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-stack-line mr-1"></i>Quantity
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-money-dollar-circle-line mr-1"></i>Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $index => $item)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->inventory->name }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->quantity }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">RM {{ number_format($item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <a href="{{ route('orders.history') }}" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">
                    Back to History
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
