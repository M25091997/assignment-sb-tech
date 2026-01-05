<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sort Urls') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center mb-3">
                <h4 class="text-lg font-semibold">Generated Sort Urls</h4>
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('short-url.create') }}"
                            class="text-white bg-green-400 hover:bg-green-500
                      focus:ring-4 focus:ring-green-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                            Generate
                        </a>
                    @endif
                @endauth

                @auth
                    @if (auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                        <a href="#"
                            class="text-white bg-gray-800 hover:bg-gray-700
                      focus:ring-4 focus:ring-gray-600
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                            Download
                        </a>
                    @endif
                @endauth
            </div>

            <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                <table class="w-full text-sm text-left rtl:text-right text-body">
                    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                        <tr>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Short Url
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Long url
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Hits
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Companies
                            </th>
                            <th scope="col" class="px-6 py-3 font-medium">
                                Date
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        @forelse (App\Models\ShortUrl::cursor() as $url)
                            <tr class="bg-neutral-primary border-b border-default">
                                <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                    <a href="{{ route('short-url.redirect', $url->code) }}"
                                        class="text-blue-600 underline">
                                        {{ url('/r/' . $url->code) }}
                                    </a>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $url->original_url }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ '0' }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $url->company->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $url->created_at->format('d M Y') }}
                                </td>
                            </tr>

                        @empty
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
