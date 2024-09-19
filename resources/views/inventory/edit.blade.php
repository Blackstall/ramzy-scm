<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Inventory Item') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-white">&times;</button>
            </div>
        @endif

        <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 gap-6 mb-6">
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Item Name') }}</label>
                    <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $inventory->name }}" required autofocus />
                </div>
                <div>
                    <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                    <textarea id="description" class="block mt-1 w-full" name="description">{{ $inventory->description }}</textarea>
                </div>
                <div>
                    <label for="price" class="block font-medium text-sm text-gray-700">{{ __('Price') }}</label>
                    <input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" value="{{ $inventory->price }}" required oninput="calculateProfit()" />
                </div>
                <div>
                    <label for="quantity" class="block font-medium text-sm text-gray-700">{{ __('Quantity') }}</label>
                    <input id="quantity" class="block mt-1 w-full" type="number" name="quantity" value="{{ $inventory->quantity }}" required />
                </div>
                <div>
                    <label for="profit_percentage" class="block font-medium text-sm text-gray-700">{{ __('Profit Percentage') }}</label>
                    <input id="profit_percentage" class="block mt-1 w-full" type="number" step="0.01" name="profit_percentage" value="{{ $inventory->profit_percentage }}" required oninput="calculateProfit()" />
                </div>
                <div>
                    <label for="estimated_profit" class="block font-medium text-sm text-gray-700">{{ __('Estimated Profit (Per Item)') }}</label>
                    <input id="estimated_profit" class="block mt-1 w-full bg-gray-100" type="text" readonly value="{{ $inventory->estimated_profit }}" />
                </div>
            </div>
            <div>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Update Item') }}
                </button>
            </div>
        </form>
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
