<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Package') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('packages.select') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($packages as $package)
                        <div class="bg-white border rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-center mb-2">
                                <i class="ri-gift-line ri-4x text-blue-500"></i>
                            </div>
                            <h3 class="text-3xl font-semibold text-center text-gray-900 mb-1">{{ $package->name }}</h3>
                            <p class="text-gray-600 text-center mb-4">{{ $package->description }}</p>
                            <p class="text-xl font-bold text-center text-gray-700 mb-4">RM {{ $package->price }}</p>
                            <div class="flex justify-center mt-4">
                                <button type="submit" name="package_id" value="{{ $package->id }}" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300 flex items-center">
                                    <i class="ri-check-line mr-2"></i>
                                    <span>Select</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
