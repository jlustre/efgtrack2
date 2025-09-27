@php
// Determine the dashboard owner's role
$dashboardOwner = $user; // The user whose dashboard we're viewing
$currentViewer = isset($viewingContext) ? $viewingContext['viewer'] : $user; // Who is viewing

// Define menu items based on dashboard owner's role
$menuItems = [];

if ($dashboardOwner->hasRole('admin')) {
$menuItems = [
[
'name' => 'Overview',
'route' => 'dashboard',
'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a1 1 0 00-1-1H4a1 1 0 00-1-1V7a3 3 0 013-3h10a3 3 0 013 3v1',
'active' => request()->routeIs('dashboard')
],
[
'name' => 'User Management',
'route' => '#',
'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0
2.25 2.25 0 014.5 0z',
'active' => false
],
[
'name' => 'System Settings',
'route' => '#',
'icon' => 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213
1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296
2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010
.255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0
01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213
1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0
01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0
01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125
1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072
1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
'active' => false
],
[
'name' => 'Reports',
'route' => '#',
'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375
21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125
1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125
1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0
01-1.125-1.125V4.125z',
'active' => false
],
[
'name' => 'Laravel Telescope',
'route' => '/telescope',
'icon' => 'M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z',
'active' => false,
'external' => true
]
];
} elseif ($dashboardOwner->hasRole('manager')) {
$menuItems = [
[
'name' => 'Dashboard',
'route' => 'dashboard',
'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a1 1 0 00-1-1H4a1 1 0 00-1-1V7a3 3 0 013-3h10a3 3 0 013 3v1',
'active' => request()->routeIs('dashboard')
],
[
'name' => 'My Team',
'route' => '#',
'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15
19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331
0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75
0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
'active' => false
],
[
'name' => 'Performance',
'route' => '#',
'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375
21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125
1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125
1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0
01-1.125-1.125V4.125z',
'active' => false
],
[
'name' => 'Commissions',
'route' => '#',
'icon' => 'M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12
12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118
0z',
'active' => false
],
[
'name' => 'Lead Management',
'route' => '#',
'icon' => 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424
48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0
00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01
8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0
1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0
3h.008v.008H6.75V18z',
'active' => false
]
];
} elseif ($dashboardOwner->hasRole('mentor')) {
$menuItems = [
[
'name' => 'Dashboard',
'route' => 'dashboard',
'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a1 1 0 00-1-1H4a1 1 0 00-1-1V7a3 3 0 013-3h10a3 3 0 013 3v1',
'active' => request()->routeIs('dashboard')
],
[
'name' => 'My Members',
'route' => '#',
'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15
19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331
0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75
0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
'active' => false
],
[
'name' => 'Sessions',
'route' => '#',
'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25
0 005.25 21h13.5a2.25 2.25 0 002.25-2.25m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121
11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0
2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0
2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z',
'active' => false
],
[
'name' => 'AI Modules',
'route' => '#',
'icon' => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813
2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.091 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0
00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75
6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5
18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25
0 00-1.423 1.423z',
'active' => false
],
[
'name' => 'Resources',
'route' => '#',
'icon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6
2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6
2.292m0-14.25v14.25',
'active' => false
],
[
'name' => 'Analytics',
'route' => '#',
'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375
21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125
1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125
1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0
01-1.125-1.125V4.125z',
'active' => false
]
];
} elseif ($dashboardOwner->hasRole('member')) {
$menuItems = [
[
'name' => 'Dashboard',
'route' => 'dashboard',
'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a1 1 0 00-1-1H4a1 1 0 00-1-1V7a3 3 0 013-3h10a3 3 0 013 3v1',
'active' => request()->routeIs('dashboard')
],
[
'name' => 'AI Training',
'route' => '#',
'icon' => 'M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813
2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.091 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0
00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75
6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5
18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25
0 00-1.423 1.423z',
'active' => false
],
[
'name' => 'My Progress',
'route' => '#',
'icon' => 'M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375
21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125
1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125
1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0
01-1.125-1.125V4.125z',
'active' => false
],
[
'name' => 'Commissions',
'route' => '#',
'icon' => 'M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12
12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118
0z',
'active' => false
],
[
'name' => 'Lead Tracker',
'route' => '#',
'icon' => 'M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424
48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0
00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01
8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0
1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0
3h.008v.008H6.75V18z',
'active' => false
],
[
'name' => 'Learning Resources',
'route' => '#',
'icon' => 'M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6
2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6
2.292m0-14.25v14.25',
'active' => false
]
];
} else {
$menuItems = [
[
'name' => 'Dashboard',
'route' => 'dashboard',
'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a1 1 0 00-1-1H4a1 1 0 00-1-1V7a3 3 0 013-3h10a3 3 0 013 3v1',
'active' => request()->routeIs('dashboard')
]
];
}
@endphp

<!-- Sidebar -->
<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
    <div class="flex flex-col flex-grow bg-white border-r border-gray-200 pt-5 pb-4 overflow-y-auto">
        <!-- Logo -->
        <div class="flex items-center flex-shrink-0 px-4">
            <a href="{{ route('landing') }}" class="flex items-center hover:opacity-75 transition-opacity duration-200">
                <svg class="h-8 w-8" style="color: var(--primary-600);" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                </svg>
                <h1 class="ml-2 text-xl font-bold text-gray-900">EFGTrack</h1>
            </a>
        </div>

        @if(isset($viewingContext))
        <!-- Viewing Context Banner -->
        <div class="mt-4 mx-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
            <div class="flex items-center">
                <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <div class="ml-2">
                    <p class="text-xs font-medium text-yellow-800">Viewing Mode</p>
                    <p class="text-xs text-yellow-700">{{ $viewingContext['viewing_as'] }}'s Dashboard</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Navigation -->
        <nav class="mt-5 flex-1 px-2 space-y-1">
            @foreach($menuItems as $item)
            @if(isset($item['external']) && $item['external'])
            <a href="{{ $item['route'] }}" target="_blank"
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $item['active'] ? 'text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                style="{{ $item['active'] ? 'background-color: var(--primary-100);' : '' }}">
                <svg class="mr-3 h-5 w-5 {{ $item['active'] ? '' : 'text-gray-400 group-hover:text-gray-500' }}"
                    style="{{ $item['active'] ? 'color: var(--primary-500);' : '' }}" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                </svg>
                {{ $item['name'] }}
                <svg class="ml-auto h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
            @else
            <a href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ $item['active'] ? 'text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} {{ $item['route'] === '#' ? 'cursor-default opacity-60' : '' }}"
                style="{{ $item['active'] ? 'background-color: var(--primary-100);' : '' }}">
                <svg class="mr-3 h-5 w-5 {{ $item['active'] ? '' : 'text-gray-400 group-hover:text-gray-500' }}"
                    style="{{ $item['active'] ? 'color: var(--primary-500);' : '' }}" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                </svg>
                {{ $item['name'] }}
                @if($item['route'] === '#')
                <span class="ml-auto text-xs text-gray-400">Soon</span>
                @endif
            </a>
            @endif
            @endforeach
        </nav>

        <!-- Logout Button -->
        <div class="px-2 mb-4">
            <livewire:logout-button />
        </div>

        <!-- User Profile Section -->
        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
            <a href="#" class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div class="ml-1">
                        <div class="flex items-center space-x-2">
                            <div class="h-8 w-8 rounded-full flex items-center justify-center"
                                style="background-color: var(--primary-500);">
                                <span class="text-sm font-medium text-white">{{ substr($dashboardOwner->name, 0, 1)
                                    }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                    {{ $dashboardOwner->name }}
                                </p>
                                <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                                    @if($dashboardOwner->hasRole('admin'))
                                    <span class="text-red-600">Admin</span>
                                    @elseif($dashboardOwner->hasRole('manager'))
                                    <span class="text-green-600">Manager</span>
                                    @elseif($dashboardOwner->hasRole('mentor'))
                                    <span class="text-purple-600">Mentor</span>
                                    @elseif($dashboardOwner->hasRole('member'))
                                    <span class="text-indigo-600">Member</span>
                                    @else
                                    <span class="text-gray-600">User</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Mobile sidebar -->
<div x-data="{ open: false }" class="md:hidden">
    <!-- Mobile menu button -->
    <div
        class="fixed top-0 left-0 z-40 flex items-center justify-between w-full h-16 bg-white border-b border-gray-200 px-4">
        <button @click="open = true" type="button"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="flex items-center hover:opacity-75 transition-opacity duration-200">
                <svg class="h-6 w-6" style="color: var(--primary-600);" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                </svg>
                <h1 class="ml-2 text-lg font-bold text-gray-900">EFGTrack</h1>
            </a>
        </div>
        <div class="w-10"></div> <!-- Spacer for centering -->
    </div>

    <!-- Mobile menu overlay -->
    <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex">
        <div @click="open = false" class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button @click="open = false" type="button"
                    class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Same content as desktop sidebar -->
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <div class="flex items-center flex-shrink-0 px-4">
                    <a href="{{ route('landing') }}"
                        class="flex items-center hover:opacity-75 transition-opacity duration-200">
                        <svg class="h-8 w-8" style="color: var(--primary-600);" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z" />
                        </svg>
                        <h1 class="ml-2 text-xl font-bold text-gray-900">EFGTrack</h1>
                    </a>
                </div>

                @if(isset($viewingContext))
                <!-- Mobile viewing context banner -->
                <div class="mt-4 mx-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="ml-2">
                            <p class="text-xs font-medium text-yellow-800">Viewing Mode</p>
                            <p class="text-xs text-yellow-700">{{ $viewingContext['viewing_as'] }}'s Dashboard</p>
                        </div>
                    </div>
                </div>
                @endif

                <nav class="mt-5 px-2 space-y-1">
                    @foreach($menuItems as $item)
                    @if(isset($item['external']) && $item['external'])
                    <a href="{{ $item['route'] }}" target="_blank"
                        class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ $item['active'] ? 'text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}"
                        style="{{ $item['active'] ? 'background-color: var(--primary-100);' : '' }}"
                        @click="open = false">
                        <svg class="mr-4 h-6 w-6 {{ $item['active'] ? '' : 'text-gray-400' }}"
                            style="{{ $item['active'] ? 'color: var(--primary-500);' : '' }}" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                        </svg>
                        {{ $item['name'] }}
                    </a>
                    @else
                    <a href="{{ $item['route'] === '#' ? '#' : route($item['route']) }}"
                        class="group flex items-center px-2 py-2 text-base font-medium rounded-md {{ $item['active'] ? 'text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} {{ $item['route'] === '#' ? 'cursor-default opacity-60' : '' }}"
                        style="{{ $item['active'] ? 'background-color: var(--primary-100);' : '' }}"
                        @click="open = false">
                        <svg class="mr-4 h-6 w-6 {{ $item['active'] ? '' : 'text-gray-400' }}"
                            style="{{ $item['active'] ? 'color: var(--primary-500);' : '' }}" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" />
                        </svg>
                        {{ $item['name'] }}
                        @if($item['route'] === '#')
                        <span class="ml-auto text-xs text-gray-400">Soon</span>
                        @endif
                    </a>
                    @endif
                    @endforeach

                    <!-- Mobile Logout Button -->
                    <livewire:logout-button />
                </nav>
            </div>

            <!-- Mobile user profile section -->
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <a href="#" class="flex-shrink-0 group block w-full">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full flex items-center justify-center"
                            style="background-color: var(--primary-500);">
                            <span class="text-sm font-medium text-white">{{ substr($dashboardOwner->name, 0, 1)
                                }}</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
                                {{ $dashboardOwner->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">
                                @if($dashboardOwner->hasRole('admin'))
                                <span class="text-red-600">Admin</span>
                                @elseif($dashboardOwner->hasRole('manager'))
                                <span class="text-green-600">Manager</span>
                                @elseif($dashboardOwner->hasRole('mentor'))
                                <span class="text-purple-600">Mentor</span>
                                @elseif($dashboardOwner->hasRole('member'))
                                <span class="text-indigo-600">Member</span>
                                @else
                                <span class="text-gray-600">User</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>