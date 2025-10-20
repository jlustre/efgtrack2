@php
$totalRecruits = \App\Services\Statistics::recruitsCount();
$recruitsLabel = \App\Services\Statistics::recruitsLabel();
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

    @include('components.stat-card', [
    'title' => __('Completed Modules'),
    'value' => ($stats['completed_modules'] ?? 0),
    'iconBg' => 'bg-blue-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253" />
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Pending Tasks'),
    'value' => ($stats['pending_tasks'] ?? 0),
    'iconBg' => 'bg-yellow-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Next Session'),
    'value' => ($stats['next_session'] ?? __('Not scheduled')),
    'iconBg' => 'bg-green-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm0 0v2m0-6V9a2 2 0 012-2h.01a2 2 0 010 4H12a2 2 0 01-2-2z" />
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => $recruitsLabel,
    'value' => $totalRecruits,
    'iconBg' => 'bg-primary-100',
    'icon' => '<svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
        </path>
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Active Mentorships'),
    'value' => 0,
    'iconBg' => 'bg-green-100',
    'icon' => '<svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
        </path>
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Pending Tasks'),
    'value' => 0,
    'iconBg' => 'bg-yellow-100',
    'icon' => '<svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Completion Rate'),
    'value' => '100%',
    'iconBg' => 'bg-purple-100',
    'icon' => '<svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
        </path>
    </svg>'
    ])


    @include('components.stat-card', [
    'title' => __('Total Users'),
    'value' => ($stats['total_users'] ?? 0),
    'iconBg' => 'bg-blue-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
    </svg>'
    ])

    @php
    // Defensive admin check: handle apps without Spatie or missing tables gracefully.
    $showAdminStats = false;
    try {
    if (\Schema::hasTable('roles') && auth()->check()) {
    $user = auth()->user();
    // If Spatie's hasRole method exists, use it. Otherwise, fall back to checking a simple is_admin flag if present.
    if (method_exists($user, 'hasRole') && $user->hasRole('admin')) {
    $showAdminStats = true;
    } elseif (isset($user->is_admin) && $user->is_admin) {
    $showAdminStats = true;
    }
    }
    } catch (\Exception $e) {
    // keep false if anything goes wrong
    $showAdminStats = false;
    }
    @endphp

    @if($showAdminStats)
    @include('components.stat-card', [
    'title' => __('Admins'),
    'value' => ($stats['total_admins'] ?? 0),
    'iconBg' => 'bg-red-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Managers'),
    'value' => ($stats['total_managers'] ?? 0),
    'iconBg' => 'bg-green-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Mentors'),
    'value' => ($stats['total_mentors'] ?? 0),
    'iconBg' => 'bg-purple-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253" />
    </svg>'
    ])

    @include('components.stat-card', [
    'title' => __('Members'),
    'value' => ($stats['total_members'] ?? 0),
    'iconBg' => 'bg-indigo-500',
    'icon' => '<svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
    </svg>'
    ])
    @endif
</div>