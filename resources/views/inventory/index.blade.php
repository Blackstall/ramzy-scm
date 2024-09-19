<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-700 leading-tight">
            {{ __('Manage Inventory') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-white">&times;</button>
            </div>
        @endif

        <h2 class="text-4xl font-extrabold text-blue-700 my-8 flex items-center">
            <i class="ri-archive-fill mr-2"></i>
            Manage Inventory
        </h2>

        <div class="mb-8 bg-white shadow-lg rounded-lg p-8">
            <form action="{{ route('inventory.store') }}" method="POST">
                @csrf
                <h3 class="text-lg font-medium text-gray-700 mb-4">Add New Item</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700 items-center">
                            <i class="ri-edit-2-line mr-2"></i> {{ __('Item Name') }}
                        </label>
                        <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="name" required autofocus />
                    </div>
                    <div>
                        <label for="description" class="block font-medium text-sm text-gray-700 items-center">
                            <i class="ri-file-list-line mr-2"></i> {{ __('Description') }}
                        </label>
                        <textarea id="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="description"></textarea>
                    </div>
                    <div>
                        <label for="price" class="block font-medium text-sm text-gray-700 items-center">
                            <i class="ri-money-dollar-box-line mr-2"></i> {{ __('Price') }}
                        </label>
                        <input id="price" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" step="0.01" name="price" required oninput="calculateProfit()" />
                    </div>
                    <div>
                        <label for="quantity" class="block font-medium text-sm text-gray-700 items-center">
                            <i class="ri-stack-line mr-2"></i> {{ __('Quantity') }}
                        </label>
                        <input id="quantity" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" name="quantity" required />
                    </div>
                    <div>
                        <label for="profit_percentage" class="block font-medium text-sm text-gray-700 items-center">
                            <i class="ri-percent-line mr-2"></i> {{ __('Profit Percentage') }}
                        </label>
                        <input id="profit_percentage" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" step="0.01" name="profit_percentage" required oninput="calculateProfit()" />
                    </div>
                    <div>
                        <label for="estimated_profit" class="block font-medium text-sm text-gray-700 items-center">
                            <i class="ri-calculator-line mr-2"></i> {{ __('Estimated Profit (Per Item)') }}
                        </label>
                        <input id="estimated_profit" class="block mt-1 w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" type="text" readonly />
                    </div>
                </div>
                <div class="mt-6 text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 flex items-center justify-center space-x-2">
                        <i class="ri-add-line"></i>
                        <span>{{ __('Add Item') }}</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-8">
            <h3 class="text-lg font-medium text-gray-700 mb-4">List of Inventory Items</h3>
            <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                <thead class="bg-blue-500">
                    <tr>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-hashtag"></i></th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-shopping-bag-line"></i> Item Name</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-file-text-line"></i> Description</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-money-dollar-box-line"></i> Price</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-stack-line"></i> Quantity</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-percent-line"></i> Profit Percentage</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-calculator-line"></i> Estimated Profit (Per Item)</th>
                        <th class="py-2 px-4 text-left text-sm font-medium text-white"><i class="ri-settings-3-line"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->name }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->description }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->price }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->quantity }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->profit_percentage }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700">{{ $item->estimated_profit }}</td>
                            <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                                <a href="{{ route('inventory.edit', $item->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700 transition duration-300 flex items-center space-x-2" onclick="return confirm('Are you sure you want to edit this item?')">
                                    <i class="ri-edit-line"></i>
                                    <span>{{ __('Edit') }}</span>
                                </a>
                                <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center space-x-2">
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
    </div>

    <script>
        function calculateProfit() {
            const price = parseFloat(document.getElementById('price').value) || 0;
            const profitPercentage = parseFloat(document.getElementById('profit_percentage').value) || 0;
            const estimatedProfit = (price * (profitPercentage / 100)).toFixed(2);
            document.getElementById('estimated_profit').value = estimatedProfit;
        }

        // Calculate profit on page load
        calculateProfit();
    </script>
</x-admin-layout>
