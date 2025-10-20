@extends('layouts.admin')

@section('content')
<div class="md:pl-64 flex flex-col flex-1">
    <!-- Top Header -->
    @include('components.topnav-user', ['title_hdr' => 'Create New User'])
    <!-- Main Content Area -->
    <div class="py-3 md:py-4 pt-10 md:pt-3">
        @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('users.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full border px-3 py-2 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create User</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-gray-600">Cancel</a>
        </form>
    </div>
</div>
@endsection