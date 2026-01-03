<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-3">
                <h4 class="text-lg font-semibold">Companies</h4>

                <a href="{{ route('company.create') }}"
                    class="text-white bg-green-400 hover:bg-green-500
                      focus:ring-4 focus:ring-green-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                    Add Company
                </a>

            </div>

            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                #
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Company Name
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Code
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Date
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($companies as $c)
                            <tr class="bg-neutral-primary border-b border-default">
                                <td class="px-6 py-4">
                                    {{ $loop->iteration }}
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    {{ $c->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $c->code ?? '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $c->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    No records found
                                </td>
                            </tr>
                        @endforelse






                    </tbody>

                </table>

            </div>
            <div class="flex justify-between items-center mb-3 mt-5">

            </div>
        </div>
    </div>



    </div>
</x-app-layout>
