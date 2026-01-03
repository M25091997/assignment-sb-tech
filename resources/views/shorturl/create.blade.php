<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow-sm rounded-lg p-6">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-lg font-semibold text-gray-800">
                    Generate Short URL
                </h4>
            </div>

            <!-- Form Card -->
            <div class=" bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="p-6 space-y-5">

                    <form class="space-y-5" action="{{ route('short-url.store') }}" method="POST">
                        @csrf

                        <!-- Client Name -->
                        <div class="mb-3">
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">
                                Long URL
                            </label>
                            <input type="url" id="name" name="original_url" placeholder="https://example.com"
                                required
                                class="w-full rounded-md border border-gray-300
                                   bg-white px-3 py-2 text-sm text-gray-900
                                   focus:outline-none focus:ring-1
                                   focus:ring-green-400 focus:border-green-400">
                            @error('original_url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <x-primary-button class="mt-3">
                            {{ __('Generate') }}
                        </x-primary-button>



                    </form>

                </div>
            </div>

        </div>
    </div>


</x-app-layout>
