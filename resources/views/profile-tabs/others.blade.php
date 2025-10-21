<div class="p-6">
    @php $profileUser = $user ?? auth()->user(); @endphp
    @include('components.theme.theme-selector-ui')

    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Other account information') }}</h3>
    @php
    use Illuminate\Support\Carbon;
    $profileUser = $user ?? auth()->user();

    // Helper to ensure we have a Carbon instance or null
    $asCarbon = function ($value) {
    if ($value instanceof Carbon) return $value;
    if (is_null($value)) return null;
    try {
    return Carbon::parse($value);
    } catch (\Throwable $e) {
    return null;
    }
    };
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <x-input-label for="is_online" :value="__('Online')" />
            <input id="is_online" type="text" readonly
                value="{{ optional($profileUser)->is_online ? __('Yes') : __('No') }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <div>
            <x-input-label for="last_active_at" :value="__('Last Active At')" />
            @php $la = $asCarbon(optional($profileUser)->last_active_at); @endphp
            <input id="last_active_at" type="text" readonly
                value="{{ $la ? ($la->format('Y-m-d H:i') . ' (' . $la->diffForHumans() . ')') : '—' }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <div>
            <x-input-label for="last_login_at" :value="__('Last Login At')" />
            @php $lla = $asCarbon(optional($profileUser)->last_login_at); @endphp
            <input id="last_login_at" type="text" readonly
                value="{{ $lla ? ($lla->format('Y-m-d H:i') . ' (' . $lla->diffForHumans() . ')') : '—' }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <div>
            <x-input-label for="last_login_ip" :value="__('Last Login IP')" />
            <input id="last_login_ip" type="text" readonly value="{{ optional($profileUser)->last_login_ip }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <div>
            <x-input-label for="member_status" :value="__('Member Status')" />
            <input id="member_status" type="text" readonly value="{{ optional($profileUser)->member_status }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <div>
            <x-input-label for="created_at" :value="__('Created At')" />
            @php $ca = $asCarbon(optional($profileUser)->created_at); @endphp
            <input id="created_at" type="text" readonly value="{{ $ca ? $ca->format('Y-m-d H:i') : '—' }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>

        <div>
            <x-input-label for="updated_at" :value="__('Updated At')" />
            @php $ua = $asCarbon(optional($profileUser)->updated_at); @endphp
            <input id="updated_at" type="text" readonly value="{{ $ua ? $ua->format('Y-m-d H:i') : '—' }}"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100" />
        </div>
    </div>

</div>