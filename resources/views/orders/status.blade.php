<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-700 leading-tight">
            <i class="ri-file-list-3-line mr-2"></i>
            {{ __('Order Status') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-6 flex items-center">
            <i class="ri-check-double-line mr-2"></i>
            Status Order
        </h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-hashtag mr-1"></i>No
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-calendar-2-line mr-1"></i>Order Date
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-money-dollar-circle-line mr-1"></i>Total Price
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-checkbox-circle-line mr-1"></i>Status
                        </th>
                        <th class="py-2 px-4 text-left text-sm font-medium">
                            <i class="ri-settings-2-line mr-1"></i>Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->id }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->created_at->toFormattedDateString() }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->total_price }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->status }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">
                                @if($order->status == 'shipped')
                                    <form action="{{ route('orders.receive', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300 flex items-center">
                                            <i class="ri-check-line mr-2"></i>{{ __('Mark as Received') }}
                                        </button>
                                    </form>
                                @else
                                    <i class="ri-eye-line text-gray-500"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
