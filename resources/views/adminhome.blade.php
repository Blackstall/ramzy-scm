<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Packages') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                    {{ session('success') }}
                    <button onclick="this.parentElement.style.display='none'" class="text-white">&times;</button>
                </div>
            @endif

            <h1 class="text-4xl font-extrabold text-blue-700 my-8 flex items-center">
                <i class="ri-shapes-fill mr-2"></i>
                Manage Franchisee Package
            </h1>

            <div class="flex items-center justify-between bg-blue-500 p-4 rounded-t-lg">
                <h2 class="text-white text-lg font-bold">Adding Franchisee Package</h2>
            </div>
            <div class="bg-white shadow-md rounded-b-lg p-6">
                <p class="mb-4 text-gray-700">You can add the package for the franchisee.</p>

                <form action="{{ route('adminhome.post') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">
                                <i class="ri-price-tag-3-line"></i> Name
                            </label>
                            <input id="name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="name" required autofocus />
                        </div>
                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700">
                                <i class="ri-file-text-line"></i> Description
                            </label>
                            <textarea id="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="description"></textarea>
                        </div>
                        <div>
                            <label for="price" class="block font-medium text-sm text-gray-700">
                                <i class="ri-money-dollar-box-line"></i> Price
                            </label>
                            <input id="price" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" step="0.01" name="price" required />
                        </div>
                        <div class="flex items-end justify-end mt-6 md:col-span-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="ri-add-line mr-2"></i> Add Package
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="py-12">
            <div class="flex items-center justify-between bg-blue-500 p-4 rounded-t-lg">
                <h1 class="text-white text-lg font-bold">List of Franchisee Package</h1>
            </div>
            <div class="bg-white shadow-md rounded-b-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">
                                    <i class="ri-price-tag-3-line"></i> Name
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">
                                    <i class="ri-file-text-line"></i> Description
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">
                                    <i class="ri-money-dollar-box-line"></i> Price
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-gray-600">
                                    <i class="ri-settings-3-line"></i> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($packages))
                                @foreach ($packages as $package)
                                    <tr>
                                        <td class="py-2 px-4 text-sm text-gray-700">{{ $package->name }}</td>
                                        <td class="py-2 px-4 text-sm text-gray-700">{{ $package->description }}</td>
                                        <td class="py-2 px-4 text-sm text-gray-700">{{ $package->price }}</td>
                                        <td class="py-2 px-4 text-sm text-gray-700 flex space-x-2">
                                            <a href="{{ route('adminhome.edit', $package->id) }}" class=" px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150 flex items-center space-x-2">
                                                <i class="ri-edit-line"></i>
                                                <span>{{ __('Edit') }}</span>
                                            </a>
                                            <form action="{{ route('adminhome.delete', $package->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class=" px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 flex items-center space-x-2">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                    <span>{{ __('Delete') }}</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="py-2 px-4 text-sm text-gray-700">No packages found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
