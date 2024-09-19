<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Purchase Orders') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-red-500 text-white">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-hashtag mr-2"></i> No</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-calendar-line mr-2"></i> Order Date</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-money-dollar-circle-line mr-2"></i> Total Price</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-checkbox-circle-line mr-2"></i> Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->id }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->created_at->toFormattedDateString() }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->total_price }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $order->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


