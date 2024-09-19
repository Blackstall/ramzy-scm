<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-red-700 leading-tight">
            <i class="ri-file-list-3-line mr-2"></i>
            {{ __('Franchise Agreement') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4 flex justify-between items-center">
                {{ session('success') }}
                <button onclick="this.parentElement.style.display='none'" class="text-white">&times;</button>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-3xl font-extrabold text-red-700 mb-6 flex items-center">
                <i class="ri-handshake-line mr-2"></i>
                Package Agreement
            </h1>
            
            <form action="{{ route('packages.submitAgreement') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="first_name" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-user-line mr-2"></i>
                            {{ __('First Name') }}
                        </label>
                        <input id="first_name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="first_name" required />
                    </div>
                    <div>
                        <label for="last_name" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-user-line mr-2"></i>
                            {{ __('Last Name') }}
                        </label>
                        <input id="last_name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="last_name" required />
                    </div>
                    <div>
                        <label for="address" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-map-pin-line mr-2"></i>
                            {{ __('Address') }}
                        </label>
                        <input id="address" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="address" required />
                    </div>
                    <div>
                        <label for="phone_number" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-phone-line mr-2"></i>
                            {{ __('Phone Number') }}
                        </label>
                        <input id="phone_number" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="text" name="phone_number" required />
                    </div>
                    <div>
                        <label for="business_experience" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-briefcase-line mr-2"></i>
                            {{ __('Year of Business Experience') }}
                        </label>
                        <input id="business_experience" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="number" name="business_experience" required />
                    </div>
                </div>

                <div class="bg-gray-100 p-4 rounded-md mb-6">
                    <h3 class="text-lg font-medium text-gray-700 flex items-center">
                        <i class="ri-file-paper-line mr-2"></i>
                        Company Terms and Conditions
                    </h3>
                    <div class="overflow-y-auto max-h-40 mt-2 p-2 bg-white rounded-md border border-gray-300">
                        <p class="text-gray-600">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Reprehenderit ea modi, ad cupiditate officia quos fuga incidunt enim repellendus unde quam neque. Magni ratione necessitatibus nesciunt aspernatur veritatis doloribus, similique quo? Similique, recusandae facilis voluptates nisi mollitia porro corrupti minus alias temporibus, eveniet quisquam distinctio veniam animi. Incidunt error sed possimus pariatur quos explicabo et optio. Excepturi, iusto maxime sint corporis distinctio deleniti! Nisi accusamus earum nulla fugiat sed expedita molestias provident consequatur, tenetur in ducimus ab delectus iure fugit amet nobis accusantium nemo ex. Dolorum totam numquam reprehenderit ea?</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="ssm_certificate" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-upload-line mr-2"></i>
                            {{ __('Upload SSM Certificate') }}
                        </label>
                        <input id="ssm_certificate" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="file" name="ssm_certificate" required />
                    </div>
                </div>

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

                    <div class="mt-4">
                        <label for="receipt" class="font-medium text-sm text-gray-700 flex items-center">
                            <i class="ri-upload-line mr-2"></i>
                            {{ __('Upload Receipt') }}
                        </label>
                        <input id="receipt" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" type="file" name="receipt" required />
                    </div>
                </div>

                <div class="flex items-center mb-6">
                    <input type="radio" id="declaration" name="declaration" value="1" class="mr-2" required>
                    <label for="declaration" class="text-gray-700">I hereby agree with the terms & conditions of the franchise</label>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-full hover:bg-red-700 transition duration-300 flex items-center justify-center">
                        <i class="ri-check-line mr-2"></i>
                        {{ __('Submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
