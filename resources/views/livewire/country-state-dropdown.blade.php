<div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Country</label>
        <select wire:model="country_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <option value="">Select a country</option>
            @foreach($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">State/Province</label>
        <select wire:model="state_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            <option value="">Select a state/province</option>
            @foreach($states as $state)
            <option value="{{ $state->id }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
</div>