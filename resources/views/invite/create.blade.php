<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Invite {{ auth()->user()->isSuperAdmin() ? 'New Client' : 'Team Members' }}
        </h2>
    </x-slot>



    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="bg-white shadow-sm rounded-lg p-6">

            {{-- <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h4 class="text-lg font-semibold text-gray-800">
                    Invite {{ auth()->user()->isSuperAdmin() ? 'New Client' : 'Team Members' }}
                </h4>
            </div> --}}

            <!-- Form Card -->
            <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="p-6 space-y-5">

                    <form class="space-y-5" action="{{ route('invite.store') }}" method="POST">
                        @csrf

                        <!-- Client Name -->
                        <div class="mb-3">
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">
                                Client Name
                            </label>
                            <input type="text" id="name" name="name" placeholder="Enter full name" required
                                class="w-full rounded-md border border-gray-300
                                   bg-white px-3 py-2 text-sm text-gray-900
                                   focus:outline-none focus:ring-1
                                   focus:ring-green-400 focus:border-green-400">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                                Client Email
                            </label>
                            <input type="email" id="email" name="email" placeholder="name@company.com" required
                                class="w-full rounded-md border border-gray-300
                                   bg-white px-3 py-2 text-sm text-gray-900
                                   focus:outline-none focus:ring-1
                                   focus:ring-green-400 focus:border-green-400">
                            @error('email')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @if (auth()->user()->isSuperAdmin())

                            <div class="mb-3">
                                <label for="role" class="block mb-1 text-sm font-medium text-gray-700">
                                    Choose Company
                                </label>

                                <select id="role" name="company_id" required
                                    class="w-full rounded-md border border-gray-300
                                    bg-white px-3 py-2 text-sm text-gray-900
                                    focus:outline-none focus:ring-1
                                    focus:ring-green-400 focus:border-green-400">

                                    <option value="" disabled selected>Select company</option>
                                    @foreach (App\Models\Company::cursor() as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        @if (auth()->user()->isAdmin())
                            <div class="mb-3">
                                <label for="role" class="block mb-1 text-sm font-medium text-gray-700">
                                    Choose Role
                                </label>

                                <select id="role" name="role" required
                                    class="w-full rounded-md border border-gray-300
                                    bg-white px-3 py-2 text-sm text-gray-900
                                    focus:outline-none focus:ring-1
                                    focus:ring-green-400 focus:border-green-400">

                                    <option value="" disabled selected>Select role</option>
                                    <option value="member">Member</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('role')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif



                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="block mb-1 text-sm font-medium text-gray-700">
                                Temporary Password
                            </label>
                            <input type="password" id="password" name="password" placeholder="••••••••" required
                                class="w-full rounded-md border border-gray-300
                                   bg-white px-3 py-2 text-sm text-gray-900
                                   focus:outline-none focus:ring-1
                                   focus:ring-green-400 focus:border-green-400">
                        </div>

                        <!-- Submit -->
                        <x-primary-button class="mt-3">
                            {{ __(' Send Invitation') }}
                        </x-primary-button>



                    </form>

                </div>
            </div>

        </div>
    </div>


</x-app-layout>
