<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>

        @auth

            @if (auth()->user()->isSuperAdmin())
                {{-- Super Admin  dashboard --}}
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-lg font-semibold">Clients</h4>

                            <a href="{{ route('invite.create') }}"
                                class="text-white bg-green-400 hover:bg-green-500
                      focus:ring-4 focus:ring-green-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                Invite
                            </a>

                        </div>

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-sm text-left rtl:text-right text-body">
                                <thead
                                    class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Companies
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Total Gen Url
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Total url Hits
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse (App\Models\User::where('role', '!=', 'superadmin')->cursor() as $user)
                                        <tr class="bg-neutral-primary border-b border-default">
                                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                                {{ $user->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->company->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->shortUrl->count() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ '0' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button class="bg-red-300 text-white rounded px-3 py-1 cursor-not-allowed"
                                                    disabled>
                                                    Delete
                                                </button>
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
                            <h4 class="text-lg font-semibold"></h4>

                            <div>
                                <a href="{{ route('invite.index') }}"
                                    class="text-white bg-purple-400 hover:bg-purple-500
                      focus:ring-4 focus:ring-purple-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                    View All
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-lg font-semibold">Generated Sort Urls</h4>
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('invite.create') }}"
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
                                    <a href="{{ route('invite.create') }}"
                                        class="text-white bg-green-400 hover:bg-green-500
                      focus:ring-4 focus:ring-green-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                        Download
                                    </a>
                                @endif
                            @endauth
                        </div>

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-sm text-left rtl:text-right text-body">
                                <thead
                                    class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
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
                            <h4 class="text-lg font-semibold"></h4>

                            <div>
                                <a href="{{ route('short-url.index') }}"
                                    class="text-white bg-purple-400 hover:bg-purple-500
                                        focus:ring-4 focus:ring-purple-300
                                        font-medium rounded text-sm px-4 py-2.5
                                        focus:outline-none">
                                    View All
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

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

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-sm text-left rtl:text-right text-body">
                                <thead
                                    class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
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

                                    @forelse (App\Models\Company::cursor() as $c)
                                        <tr class="bg-neutral-primary border-b border-default">
                                            <td class="px-6 py-4">
                                                {{ $loop->iteration }}
                                            </td>

                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-heading whitespace-nowrap">
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
                            <h4 class="text-lg font-semibold"></h4>

                            <div>
                                <a href="{{ route('company.index') }}"
                                    class="text-white bg-purple-400 hover:bg-purple-500
                      focus:ring-4 focus:ring-purple-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                    View All
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->isAdmin())
                {{-- Admin  dashboard --}}
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

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-sm text-left rtl:text-right text-body">
                                <thead
                                    class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
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
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-heading whitespace-nowrap">
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
                                                {{ '-' }}
                                            </td>

                                            <td class="px-6 py-4">
                                                {{ $url->created_at->format('d M Y') }}
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
                            <h4 class="text-lg font-semibold"></h4>

                            <div>
                                <a href="{{ route('short-url.index') }}"
                                    class="text-white bg-purple-400 hover:bg-purple-500
                                        focus:ring-4 focus:ring-purple-300
                                        font-medium rounded text-sm px-4 py-2.5
                                        focus:outline-none">
                                    View All
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-lg font-semibold">Team Members</h4>

                            <a href="{{ route('invite.create') }}"
                                class="text-white bg-green-400 hover:bg-green-500
                      focus:ring-4 focus:ring-green-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                Invite
                            </a>

                        </div>

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-sm text-left rtl:text-right text-body">
                                <thead
                                    class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Companies
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Total Generated Url
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Total Url Hits
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 font-medium">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse (App\Models\User::where('role', 'member')->where('company_id', auth()->user()->company_id)->get() as $user)
                                        <tr class="bg-neutral-primary border-b border-default">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                                {{ $user->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->role }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->company->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->shortUrl->count() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ '0' }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $user->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button class="bg-red-300 text-white rounded px-3 py-1 cursor-not-allowed"
                                                    disabled>
                                                    Delete
                                                </button>
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
                            <h4 class="text-lg font-semibold"></h4>

                            <div>
                                <a href="{{ route('invite.index') }}"
                                    class="text-white bg-purple-400 hover:bg-purple-500
                      focus:ring-4 focus:ring-purple-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                    View All
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->isMember())
                {{-- Member  dashboard --}}
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h4 class="text-lg font-semibold">Generated Sort Urls</h4>
                            @auth
                                @if (auth()->user()->isAdmin() || auth()->user()->isMember())
                                    <a href="{{ route('short-url.create') }}"
                                        class="text-white bg-green-400 hover:bg-green-500
                      focus:ring-4 focus:ring-green-300
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                        Generate
                                    </a>
                                @endif
                            @endauth


                            <a href="#"
                                class="text-white bg-gray-800 hover:bg-gray-700
                      focus:ring-4 focus:ring-gray-600
                      font-medium rounded text-sm px-4 py-2.5
                      focus:outline-none">
                                Download
                            </a>

                        </div>

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-sm text-left rtl:text-right text-body">
                                <thead
                                    class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
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
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-heading whitespace-nowrap">
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
                                                {{ '-' }}
                                            </td>

                                            <td class="px-6 py-4">
                                                {{ $url->created_at->format('d M Y') }}
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
                            <h4 class="text-lg font-semibold"></h4>

                            <div>
                                <a href="{{ route('short-url.index') }}"
                                    class="text-white bg-purple-400 hover:bg-purple-500
                                        focus:ring-4 focus:ring-purple-300
                                        font-medium rounded text-sm px-4 py-2.5
                                        focus:outline-none">
                                    View All
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            @endif





        </div>
    @endauth
</x-app-layout>
