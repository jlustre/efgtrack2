<div class="p-6">
    @php
    $profileUser = $user ?? auth()->user();
    $currentUser = auth()->user();
    // Determine if current user can edit business info: admin, assigned mentor, or assigned manager
    $canEditBusinessInfo = ($isAdmin ?? false)
    || ($currentUser && ($currentUser->id == ($profileUser->assigned_mentor_id ?? null)))
    || ($currentUser && ($currentUser->id == ($profileUser->assigned_manager_id ?? null)));
    @endphp

    <form wire:submit.prevent="updateProfileInformation" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Rank -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Rank') }}</label>
                <select wire:model="rank_id" name="rank_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">{{ __('Select Rank') }}</option>
                    {{-- component provides $ranks --}}
                    @foreach(($ranks ?? []) as $rank)
                    <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                    @endforeach
                </select>
                @error('rank_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <!-- Assigned Mentor -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Assigned Mentor') }}</label>
                <select wire:model="assigned_mentor_id" name="assigned_mentor_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">{{ __('Select Mentor') }}</option>
                    @foreach(($mentors ?? []) as $m)
                    <option value="{{ $m->id }}">{{ $m->display_name }}</option>
                    @endforeach
                </select>
                @error('assigned_mentor_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <!-- Assigned Manager -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Assigned Manager') }}</label>
                <select wire:model="assigned_manager_id" name="assigned_manager_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">{{ __('Select Manager') }}</option>
                    @foreach(($managers ?? []) as $mm)
                    <option value="{{ $mm->id }}">{{ $mm->display_name }}</option>
                    @endforeach
                </select>
                @error('assigned_manager_id')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            <!-- Licensed -->
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('Licensed') }}</label>
                <select wire:model="is_licensed" name="is_licensed"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                    <option value="">{{ __('Select') }}</option>
                    <option value="1">{{ __('Yes') }}</option>
                    <option value="0">{{ __('No') }}</option>
                </select>
                @error('is_licensed')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="pt-4">
            @if($canEditBusinessInfo)
            <x-primary-button>{{ __('Save Business Info') }}</x-primary-button>
            <x-action-message class="ms-3" on="profile-updated">{{ __('Saved.') }}</x-action-message>
            <!-- Inline fallback that auto-hides and is two-way bound to the Livewire property -->
            <div x-data="{ shown: @entangle('showSuccess') }" x-init="if(shown){ setTimeout(()=> shown = false, 2500) }"
                x-show="shown" x-cloak class="text-sm text-green-600 ms-3 inline">
                {{ __('Business Info Saved.') }}
            </div>
            @else
            <div class="text-sm text-red-600">
                {{ __('These fields can only be changed by an administrator, the user\'s assigned mentor, or the
                assigned manager.') }}
            </div>
            @endif
        </div>
    </form>
</div>