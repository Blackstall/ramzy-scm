<!-- orders/create.blade.php -->

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Purchase Order') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6 flex items-center text-red-700">
            <i class="ri-shopping-cart-line mr-2"></i>
            Purchase Order
        </h1>

        <form id="orderForm" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @foreach ($inventoryItems as $item)
                    <div class="border rounded-lg p-4 border-red-500 ">

                        <div class="flex items-center mb-4">
                            <i class="ri-shopping-bag-3-line ri-2x text-red-500 mr-2"></i>
                            <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                        </div>

                        <p>{{ $item->description }}</p>
                        <p class="text-gray-700 font-bold">RM{{ $item->price }}</p>
                        <input type="number" name="items[{{ $item->id }}][quantity]" class="mt-2 w-full quantity-input" data-price="{{ $item->price }}" placeholder="Quantity" min="1">
                        <input type="hidden" name="items[{{ $item->id }}][price]" value="{{ $item->price }}">
                        <input type="hidden" name="items[{{ $item->id }}][inventory_id]" value="{{ $item->id }}">
                        <p class="mt-2 text-gray-700">Total Price: RM<span class="total-price">0.00</span></p>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <div class="bg-gray-100 p-4 rounded-md mb-6">
                    <h3 class="text-lg font-medium text-gray-700 flex items-center">
                        <i class="ri-bank-line mr-2"></i>
                        Payment Details
                    </h3>
                    <p class="text-gray-700">Bank Name: Maybank</p>
                    <p class="text-gray-700">Bank Owner: Muhammad Farris Zul'Emir Bin Nasarudin</p>
                    <p class="text-gray-700">Bank Account: 158417169050</p>
                    <div class="bg-red-100 p-2 rounded mt-2">
                        <p class="text-red-700 font-semibold flex items-center">
                            <i class="ri-alert-line mr-2"></i>
                            Important!! Please upload the receipt after making the payment within 24 hours.
                        </p>
                    </div>

                <label for="receipt" class="block text-sm font-medium text-gray-700">{{ __('Upload Receipt') }}</label>
                <input type="file" name="receipt" id="receipt" class="mt-2 w-full">
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Overall Price: RM<span id="overall-price">0.00</span></p>
            </div>
            <div>
                <button type="button" onclick="confirmOrder()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center">
                    <i class="ri-check-line mr-2"></i> {{ __('Place Order') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('input', function () {
                    calculateTotalPrice(this);
                });
            });
        });

        function calculateTotalPrice(element) {
            const quantity = parseFloat(element.value) || 0;
            const price = parseFloat(element.dataset.price) || 0;
            const totalPriceElement = element.closest('.border').querySelector('.total-price');
            const totalPrice = (quantity * price).toFixed(2);
            totalPriceElement.innerText = totalPrice;

            calculateOverallPrice();
        }

        function calculateOverallPrice() {
            let overallPrice = 0;
            document.querySelectorAll('.total-price').forEach(element => {
                overallPrice += parseFloat(element.innerText) || 0;
            });
            document.getElementById('overall-price').innerText = overallPrice.toFixed(2);
        }

        function confirmOrder() {
            let confirmMessage = 'Are you sure you want to place this order?';
            if (confirm(confirmMessage)) {
                document.getElementById('orderForm').submit();
            }
        }
    </script>
</x-app-layout> --}}


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-700 leading-tight">
            <i class="ri-shopping-basket-line mr-2"></i>
            {{ __('Create Purchase Order') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6 flex items-center text-red-700">
            <i class="ri-shopping-cart-line mr-2"></i>
            Purchase Order
        </h1>

        <form id="orderForm" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                @foreach ($inventoryItems as $item)
                    <div class="border border-red-500 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-center mb-4">
                            <i class="ri-shopping-bag-3-line ri-2x text-red-500 mr-2"></i>
                            <h3 class="text-lg font-semibold text-red-700">{{ $item->name }}</h3>
                        </div>
                        <p class="text-gray-600">{{ $item->description }}</p>
                        <p class="text-gray-700 font-bold">RM{{ $item->price }}</p>
                        <input type="number" name="items[{{ $item->id }}][quantity]" class="mt-2 w-full quantity-input border border-gray-300 rounded-md p-2" data-price="{{ $item->price }}" placeholder="Quantity" min="1" oninput="calculateTotalPrice(this)">
                        <input type="hidden" name="items[{{ $item->id }}][price]" value="{{ $item->price }}">
                        <input type="hidden" name="items[{{ $item->id }}][inventory_id]" value="{{ $item->id }}">
                        <p class="mt-2 text-gray-700">Total Price: RM<span class="total-price">0.00</span></p>
                    </div>
                @endforeach
            </div>
            <div class="mb-4">
                <label for="receipt" class="block text-sm font-medium text-gray-700">{{ __('Upload Receipt') }}</label>
                <input type="file" name="receipt" id="receipt" class="mt-2 w-full border border-gray-300 rounded-md p-2">
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Overall Price: RM<span id="overall-price">0.00</span></p>
            </div>
            <div>
                <button type="button" onclick="confirmOrder()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center">
                    <i class="ri-check-line mr-2"></i>{{ __('Place Order') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('input', function () {
                    calculateTotalPrice(this);
                });
            });
        });

        function calculateTotalPrice(element) {
            const quantity = parseFloat(element.value) || 0;
            const price = parseFloat(element.dataset.price) || 0;
            const totalPriceElement = element.closest('.border').querySelector('.total-price');
            const totalPrice = (quantity * price).toFixed(2);
            totalPriceElement.innerText = totalPrice;

            calculateOverallPrice();
        }

        function calculateOverallPrice() {
            let overallPrice = 0;
            document.querySelectorAll('.total-price').forEach(element => {
                overallPrice += parseFloat(element.innerText) || 0;
            });
            document.getElementById('overall-price').innerText = overallPrice.toFixed(2);
        }

        function confirmOrder() {
            let confirmMessage = 'Are you sure you want to place this order?';
            if (confirm(confirmMessage)) {
                document.getElementById('orderForm').submit();
            }
        }
    </script>
</x-app-layout> --}}

<!-- orders/create.blade.php -->


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Purchase Order') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6 flex items-center text-red-700">
            <i class="ri-shopping-cart-line mr-2"></i>
            Purchase Order
        </h1>

        <form id="orderForm" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @foreach ($inventoryItems as $item)
                    <div class="border rounded-lg p-4 border-red-500 text-center">
                        <i class="ri-shopping-bag-3-line ri-4x text-red-500 mb-4"></i>
                        <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                        <p class="text-gray-700 font-bold">RM{{ $item->price }}</p>
                        <input type="number" name="items[{{ $item->id }}][quantity]" class="mt-2 w-full quantity-input" data-price="{{ $item->price }}" placeholder="Quantity" min="1">
                        <input type="hidden" name="items[{{ $item->id }}][price]" value="{{ $item->price }}">
                        <input type="hidden" name="items[{{ $item->id }}][inventory_id]" value="{{ $item->id }}">
                        <p class="mt-2 text-gray-700">Total Price: RM<span class="total-price">0.00</span></p>
                    </div>
                @endforeach
            </div>
            <div class="mb-4 bg-gray-100 p-4 rounded-md">
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="ri-bank-line mr-2"></i>
                    Payment Details
                </h3>
                <p class="text-gray-700">Bank Name: Maybank</p>
                <p class="text-gray-700">Bank Owner: Muhammad Farris Zul'Emir Bin Nasarudin</p>
                <p class="text-gray-700">Bank Account: 158417169050</p>
                <div class="bg-red-100 p-2 rounded mt-2">
                    <p class="text-red-700 font-semibold flex items-center">
                        <i class="ri-alert-line mr-2"></i>
                        Important!! Please upload the receipt after making the payment within 24 hours.
                    </p>
                </div>
            </div>
            <div class="mb-4">
                <label for="receipt" class="block text-sm font-medium text-gray-700">{{ __('Upload Receipt') }}</label>
                <input type="file" name="receipt" id="receipt" class="mt-2 w-full">
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Overall Price: RM<span id="overall-price">0.00</span></p>
            </div>
            <div>
                <button type="button" onclick="confirmOrder()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center">
                    <i class="ri-check-line mr-2"></i>{{ __('Place Order') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('input', function () {
                    calculateTotalPrice(this);
                });
            });
        });

        function calculateTotalPrice(element) {
            const quantity = parseFloat(element.value) || 0;
            const price = parseFloat(element.dataset.price) || 0;
            const totalPriceElement = element.closest('.border').querySelector('.total-price');
            const totalPrice = (quantity * price).toFixed(2);
            totalPriceElement.innerText = totalPrice;

            calculateOverallPrice();
        }

        function calculateOverallPrice() {
            let overallPrice = 0;
            document.querySelectorAll('.total-price').forEach(element => {
                overallPrice += parseFloat(element.innerText) || 0;
            });
            document.getElementById('overall-price').innerText = overallPrice.toFixed(2);
        }

        function confirmOrder() {
            let confirmMessage = 'Are you sure you want to place this order?';
            if (confirm(confirmMessage)) {
                document.getElementById('orderForm').submit();
            }
        }
    </script>
</x-app-layout> --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Purchase Order') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-6 flex items-center text-red-700">
            <i class="ri-shopping-cart-line mr-2"></i>
            Purchase Order
        </h1>

        <form id="orderForm" action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                @foreach ($inventoryItems as $item)
                    <div class="border rounded-lg p-4 border-red-500 text-center">
                        <i class="ri-shopping-bag-3-line ri-4x text-red-500 mb-4"></i>
                        <h3 class="text-lg font-semibold">{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                        <p class="text-gray-700 font-bold">RM{{ $item->price }}</p>
                        <input type="number" name="items[{{ $item->id }}][quantity]" class="mt-2 w-full quantity-input" data-price="{{ $item->price }}" placeholder="Quantity" min="1">
                        <input type="hidden" name="items[{{ $item->id }}][price]" value="{{ $item->price }}">
                        <input type="hidden" name="items[{{ $item->id }}][inventory_id]" value="{{ $item->id }}">
                        <p class="mt-2 text-gray-700">Total Price: RM<span class="total-price">0.00</span></p>
                    </div>
                @endforeach
            </div>
            <div class="mb-4 bg-gray-100 p-4 rounded-md border border-gray-300 w-1/2">
                <h3 class="text-lg font-medium text-gray-700 flex items-center">
                    <i class="ri-bank-line mr-2"></i>
                    Payment Details
                </h3>
                <p class="text-gray-700">Bank Name: Maybank</p>
                <p class="text-gray-700">Bank Owner: Muhammad Farris Zul'Emir Bin Nasarudin</p>
                <p class="text-gray-700">Bank Account: 158417169050</p>
                <div class="bg-red-100 p-1 rounded mt-2 text-sm">
                    <p class="text-red-700 font-semibold flex items-center">
                        <i class="ri-alert-line mr-2"></i>
                        Important!! Please upload the receipt after making the payment within 24 hours.
                    </p>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="receipt" class="block text-sm font-medium text-gray-700">{{ __('Upload Receipt') }}</label>
                <input type="file" name="receipt" id="receipt" class="mt-2 w-full">
            </div> 

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-700">Overall Price: RM<span id="overall-price">0.00</span></p>
            </div>
            <div>
                <button type="button" onclick="confirmOrder()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center">
                    <i class="ri-check-line mr-2"></i>{{ __('Place Order') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('input', function () {
                    calculateTotalPrice(this);
                });
            });
        });

        function calculateTotalPrice(element) {
            const quantity = parseFloat(element.value) || 0;
            const price = parseFloat(element.dataset.price) || 0;
            const totalPriceElement = element.closest('.border').querySelector('.total-price');
            const totalPrice = (quantity * price).toFixed(2);
            totalPriceElement.innerText = totalPrice;

            calculateOverallPrice();
        }

        function calculateOverallPrice() {
            let overallPrice = 0;
            document.querySelectorAll('.total-price').forEach(element => {
                overallPrice += parseFloat(element.innerText) || 0;
            });
            document.getElementById('overall-price').innerText = overallPrice.toFixed(2);
        }

        function confirmOrder() {
            let confirmMessage = 'Are you sure you want to place this order?';
            if (confirm(confirmMessage)) {
                document.getElementById('orderForm').submit();
            }
        }
    </script>
</x-app-layout>
