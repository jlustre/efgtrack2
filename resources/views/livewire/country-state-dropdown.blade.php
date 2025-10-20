<div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">{{ __('Country') }}</label>
        <select wire:model="country_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <option value="">{{ __('Select a country') }}</option>
            {{-- Support either $countries (controller-provided) or $activeCountries (component-provided) --}}
            @foreach(($countries ?? $activeCountries ?? []) as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">{{ __('State/Province') }}</label>
        <select wire:model="state_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <option value="">{{ __('Select a state/province') }}</option>
            @foreach(($states ?? []) as $state)
            <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
</div>