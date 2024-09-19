<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Package') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('adminhome.update', $package->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Name') }}</label>
                        <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $package->name }}" required autofocus />
                    </div>
                    <div>
                        <label for="description" class="block font-medium text-sm text-gray-700">{{ __('Description') }}</label>
                        <textarea id="description" class="block mt-1 w-full" name="description">{{ $package->description }}</textarea>
                    </div>
                    <div>
                        <label for="price" class="block font-medium text-sm text-gray-700">{{ __('Price') }}</label>
                        <input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" value="{{ $package->price }}" required />
                    </div>
                    <div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            {{ __('Update Package') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
