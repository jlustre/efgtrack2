@extends('layouts.admin')

@section('content')

<!-- Main Content -->
<div class="md:pl-64 flex flex-col flex-1">
    <!-- Top Header -->
    @include('components.top-header', ['title_hdr' => __('User Management'), 'viewingContext' => $viewingContext ??
    null])

    <!-- Main Content Area -->
    <div class="py-3 md:py-4 pt-10 md:pt-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif
            <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">{{
                __('Add User') }}</a>

            @php
            $sort = request('sort', 'id');
            $direction = request('direction', 'desc');
            @endphp

            <!-- Filters -->
            <form method="GET" action="{{ route('users.index') }}"
                class="mb-4 flex flex-col sm:flex-row gap-2 items-start">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="{{ __('Search name, username or email') }}"
                        class="w-full border px-3 py-2 rounded" />
                </div>
                <div>
                    <select name="member_status" class="border px-3 py-2 rounded">
                        <option value="">{{ __('All Statuses') }}</option>
                        <option value="pending" {{ request('member_status')=='pending' ? 'selected' : '' }}>{{
                            __('Pending') }}
                        </option>
                        <option value="active" {{ request('member_status')=='active' ? 'selected' : '' }}>{{
                            __('Active') }}
                        </option>
                        <option value="inactive" {{ request('member_status')=='inactive' ? 'selected' : '' }}>{{
                            __('Inactive') }}
                        </option>
                        <option value="suspended" {{ request('member_status')=='suspended' ? 'selected' : '' }}>{{
                            __('Suspended') }}</option>
                    </select>
                </div>
                <div>
                    <select name="country_id" class="border px-3 py-2 rounded">
                        <option value="">{{ __('All Countries') }}</option>
                        @foreach($countries as $c)
                        <option value="{{ $c->id }}" {{ request('country_id')==$c->id ? 'selected' : '' }}>{{ $c->name
                            }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="per_page" class="border px-3 py-2 rounded">
                        <option value="10" {{ request('per_page')==10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page',25)==25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                </div>
            </form>

            <div class="overflow-x-auto -mx-4 sm:-mx-0 px-4 sm:px-0">
                <div class="inline-block min-w-[900px] w-full">
                    <table class="min-w-full bg-white border table-auto whitespace-nowrap">
                        <thead>
                            <tr class="text-left">
                                <th class="py-2 px-4 border-b">{{ __('Actions') }}</th>
                                <th class="py-2 px-4 border-b">
                                    @php $d = ($sort === 'id' && $direction === 'asc') ? 'desc' : 'asc'; @endphp
                                    <a href="{{ route('users.index', array_merge(request()->except('page'), ['sort' => 'id', 'direction' => $d])) }}"
                                        class="inline-flex items-center">
                                        {{ __('ID') }}
                                        @if($sort === 'id')
                                        @if($direction === 'asc')
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 11l5-5 5 5H5z" />
                                        </svg>
                                        @else
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 9l5 5 5-5H5z" />
                                        </svg>
                                        @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="py-2 px-4 border-b">{{ __('Avatar') }}</th>
                                <th class="py-2 px-4 border-b">
                                    @php $d = ($sort === 'username' && $direction === 'asc') ? 'desc' : 'asc'; @endphp
                                    <a href="{{ route('users.index', array_merge(request()->except('page'), ['sort' => 'username', 'direction' => $d])) }}"
                                        class="inline-flex items-center">
                                        {{ __('Username / Sponsor') }}
                                        @if($sort === 'username')
                                        @if($direction === 'asc')
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 11l5-5 5 5H5z" />
                                        </svg>
                                        @else
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 9l5 5 5-5H5z" />
                                        </svg>
                                        @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="py-2 px-4 border-b hidden sm:table-cell">
                                    @php $d = ($sort === 'name' && $direction === 'asc') ? 'desc' : 'asc'; @endphp
                                    <a href="{{ route('users.index', array_merge(request()->except('page'), ['sort' => 'name', 'direction' => $d])) }}"
                                        class="inline-flex items-center">
                                        {{ __('Name') }}
                                        @if($sort === 'name')
                                        @if($direction === 'asc')
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 11l5-5 5 5H5z" />
                                        </svg>
                                        @else
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 9l5 5 5-5H5z" />
                                        </svg>
                                        @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="py-2 px-4 border-b">
                                    @php $d = ($sort === 'email' && $direction === 'asc') ? 'desc' : 'asc'; @endphp
                                    <a href="{{ route('users.index', array_merge(request()->except('page'), ['sort' => 'email', 'direction' => $d])) }}"
                                        class="inline-flex items-center">
                                        {{ __('Email') }} / {{ __('Phone') }}
                                        @if($sort === 'email')
                                        @if($direction === 'asc')
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 11l5-5 5 5H5z" />
                                        </svg>
                                        @else
                                        <svg class="ml-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M5 9l5 5 5-5H5z" />
                                        </svg>
                                        @endif
                                        @endif
                                    </a>
                                </th>
                                <th class="py-2 px-4 border-b hidden md:table-cell">{{ __('Location') }}</th>
                                <th class="py-2 px-4 border-b hidden lg:table-cell">{{ __('Assigned Mentor') }}</th>
                                <th class="py-2 px-4 border-b hidden lg:table-cell">{{ __('Assigned Manager') }}</th>
                                <th class="py-2 px-4 border-b hidden lg:table-cell">{{ __('Created') }}</th>
                                <th class="py-2 px-4 border-b hidden lg:table-cell">{{ __('Member Status') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y">
                            @foreach($users as $user)
                            @php
                            $avatar = $user->avatar_url ?? ($user->avatar ?? null);
                            if (!$avatar && isset($user->email)) {
                            $avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) .
                            '?s=40&d=mp';
                            }
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b align-top">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('users.edit', $user) }}" title="{{ __('Edit') }}"
                                            class="inline-flex items-center p-1 rounded-full bg-yellow-400 text-white group hover:shadow">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5h6M12 7l7 7-4 4-7-7 4-4z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="{{ __('Delete') }}"
                                                onclick="return confirm('{{ __('Are you sure?') }}')"
                                                class="inline-flex items-center p-1 rounded-full bg-red-500 text-white group hover:shadow">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="py-2 px-4 border-b align-top">{{ $user->id }}</td>
                                <td class="py-2 px-4 border-b align-top">
                                    @if($avatar)
                                    <img src="{{ $avatar }}" alt="{{ $user->name }}" class="h-8 w-8 rounded-full" />
                                    @else
                                    <div class="h-8 w-8 bg-gray-200 rounded-full"></div>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-sm align-top">
                                    <div class="font-medium">{{ $user->username ?? $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ optional($user->sponsor)->username ??
                                        optional($user->sponsor)->name ?? '-' }}</div>
                                </td>
                                <td class="py-2 px-4 border-b text-sm hidden sm:table-cell align-top">{{ $user->name }}
                                </td>

                                <td class="py-2 px-4 border-b align-top">
                                    <div class="text-xs">{{ $user->email }}</div>
                                    <div class="text-xs text-gray-600">{{ $user->formatted_phone }}</div>
                                </td>
                                <td class="py-2 px-4 border-b text-sm hidden md:table-cell align-top">{{ $user->location
                                    ?: '-' }}</td>
                                <td class="py-2 px-4 border-b text-sm hidden lg:table-cell align-top">{{
                                    optional($user->mentor)->name ?? optional($user->mentor)->username ?? '-' }}</td>
                                <td class="py-2 px-4 border-b text-sm hidden lg:table-cell align-top">{{
                                    optional($user->manager)->name ?? optional($user->manager)->username ?? '-' }}</td>
                                <td class="py-2 px-4 border-b text-xs hidden lg:table-cell align-top">{{
                                    $user->created_at ?
                                    $user->created_at->diffForHumans() : '-' }}</td>
                                <td class="py-2 px-4 border-b text-center hidden lg:table-cell align-top">{{
                                    $user->member_status ?? $user->status ?? '-' }}</td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile per-user details (for small screens) -->
            <div class="mt-4 lg:hidden space-y-3">
                @foreach($users as $user)
                <div class="border rounded p-3">
                    <div class="flex justify-between items-center">
                        <div>
                            <div class="font-medium">{{ $user->username ?? $user->name }}</div>
                            <div class="text-xs text-gray-600">{{ $user->email }} • {{ $user->formatted_phone }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs text-gray-500">{{ $user->member_status ?? $user->status ?? '-' }}</div>
                            <div class="mt-2">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 text-sm">{{ __('Edit')
                                    }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-gray-700">
                        <div><strong>{{ __('Location') }}:</strong> {{ $user->location ?: '-' }}</div>
                        <div><strong>{{ __('Mentor') }}:</strong> {{ optional($user->mentor)->name ??
                            optional($user->mentor)->username ?? '-' }}</div>
                        <div><strong>{{ __('Manager') }}:</strong> {{ optional($user->manager)->name ??
                            optional($user->manager)->username ?? '-' }}</div>
                        <div><strong>{{ __('Joined') }}:</strong> {{ $user->created_at ?
                            $user->created_at->diffForHumans() : '-' }}</div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</div>

@endsection