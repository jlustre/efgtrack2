<div class="space-y-6">
    @php $profileUser = $user ?? auth()->user(); @endphp
    <!-- Current Avatar -->
    <div class="text-center">
        <div class="relative inline-block">
            <img class="h-24 w-24 rounded-full object-cover mx-auto border-4 border-gray-200" src="{{ $currentAvatar }}"
                alt="{{ $profileUser->display_name }}">

            @if($profileUser->avatar_path)
            <button wire:click="removeAvatar"
                wire:confirm="{{ __('Are you sure you want to remove your profile picture?') }}"
                class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full p-1 shadow-lg transition-colors duration-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
            @endif
        </div>

        <div class="mt-2 text-sm text-gray-500">
            {{ $profileUser->avatar_path ? __('Custom avatar') : __('Default avatar') }}
        </div>
    </div>

    <!-- Upload Form -->
    <form wire:submit="uploadAvatar" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Choose new profile picture') }}
            </label>

            <div
                class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors duration-200">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <div class="flex text-sm text-gray-600">
                        <label for="avatar-upload"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>{{ __('Upload a file') }}</span>
                            <input wire:model="avatar" id="avatar-upload" name="avatar-upload" type="file"
                                accept="image/*" class="sr-only">
                        </label>
                        <p class="pl-1">{{ __('or drag and drop') }}</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        {{ __('PNG, JPG, GIF up to 2MB') }}
                    </p>
                </div>
            </div>

            @error('avatar')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Preview -->
        @if ($avatar)
        <div class="mt-4">
            <div class="text-sm font-medium text-gray-700 mb-2">{{ __('Preview:') }}</div>
            <div class="flex items-center space-x-4">
                <img class="h-16 w-16 rounded-full object-cover" src="{{ $avatar->temporaryUrl() }}" alt="Preview">
                <div>
                    <div class="text-sm text-gray-900">{{ $avatar->getClientOriginalName() }}</div>
                    <div class="text-xs text-gray-500">{{ number_format($avatar->getSize() / 1024, 1) }} KB</div>
                </div>
            </div>
        </div>
        @endif

        <!-- Upload Button -->
        @if ($avatar)
        <div class="flex justify-end">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                wire:loading.attr="disabled" wire:target="uploadAvatar">
                <span wire:loading.remove wire:target="uploadAvatar">{{ __('Upload Avatar') }}</span>
                <span wire:loading wire:target="uploadAvatar">
                    <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    {{ __('Uploading...') }}
                </span>
            </button>
        </div>
        @endif
    </form>

    <!-- Status Messages -->
    @if (session('avatar-status'))
    <div class="p-3 bg-green-50 border border-green-200 rounded-md">
        <div class="flex">
            <svg class="h-5 w-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <p class="text-sm text-green-700">{{ session('avatar-status') }}</p>
        </div>
    </div>
    @endif

    <!-- Tips -->
    <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
        <div class="flex">
            <svg class="h-5 w-5 text-blue-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h4 class="text-sm font-medium text-blue-800">{{ __('Profile Picture Tips') }}</h4>
                <div class="text-sm text-blue-700 mt-1">
                    <ul class="list-disc list-inside space-y-1">
                        <li>{{ __('Use a clear, professional headshot') }}</li>
                        <li>{{ __('Square images work best (1:1 ratio)') }}</li>
                        <li>{{ __('Minimum size: :size pixels', ['size' => '200x200']) }}</li>
                        <li>{{ __('Keep file size under 2MB') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>