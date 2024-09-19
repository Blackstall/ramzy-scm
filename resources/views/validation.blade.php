<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Franchisee Status') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="py-12">
            <h1 class="text-4xl font-extrabold text-blue-700 my-8 flex items-center">
                <i class="ri-shake-hands-line mr-2"></i>
                Manage Franchisee Status
            </h1>

            <div class="flex items-center justify-between bg-blue-500 p-4 rounded-t-lg">
                <h2 class="text-white text-lg font-bold">List of Franchisee Status</h2>
            </div>
            <div class="bg-white shadow-md rounded-b-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                        <thead class="bg-blue-500">
                            <tr>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-hashtag"></i> Number
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-user-line"></i> Username
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-shield-check-line"></i> Status
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-file-list-3-line"></i> Actions
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-file-list-3-line"></i> Receipt
                                </th>
                                <th class="py-2 px-4 text-left text-sm font-medium text-white">
                                    <i class="ri-settings-3-line"></i> Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($franchisees as $franchisee)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                                    <td class="py-2 px-4 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700">{{ $franchisee->name }}</td>
                                    <td class="py-2 px-4 text-sm">
                                        <select class="status-dropdown block w-full mt-1 text-sm text-gray-700 bg-white border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300" data-id="{{ $franchisee->id }}">
                                            <option value="Registered" {{ $franchisee->status == 'Registered' ? 'selected' : '' }}>
                                                Registered
                                            </option>
                                            <option value="Paid" {{ $franchisee->status == 'Paid' ? 'selected' : '' }}>
                                                Paid
                                            </option>
                                            <option value="Completed" {{ $franchisee->status == 'Completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                        </select>
                                    </td>

                                    <td class="py-2 px-4 text-sm text-gray-700">
                                        @if($franchisee->ssm_certificate)
                                            <a href="{{ asset('storage/' . $franchisee->ssm_certificate) }}" target="_blank">
                                                View SSM Certificate
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="py-2 px-4 text-sm text-gray-700">
                                        @if($franchisee->receipt)
                                            <a href="{{ asset('storage/' . $franchisee->receipt) }}" target="_blank">
                                                View Receipt
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td> 

                                    <td class="py-2 px-4 text-sm text-gray-700">
                                        <form action="{{ route('validation.destroy', $franchisee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300 flex items-center">
                                                <i class="ri-delete-bin-6-line"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.status-dropdown').change(function() {
                var status = $(this).val();
                var userId = $(this).data('id');

                $.ajax({
                    url: '{{ url("/validation") }}/' + userId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        alert(response.success);
                    },
                    error: function(response) {
                        console.log(response);
                        alert('Error updating status');
                    }
                });
            });
        });
    </script>
</x-admin-layout>
