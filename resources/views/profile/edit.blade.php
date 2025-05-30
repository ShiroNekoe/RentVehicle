@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg p-8 bg-white rounded-xl shadow-lg" x-data="{ showDelete: false }">
    <h2 class="text-3xl font-extrabold text-gray-900 mb-8 text-center">Edit Profile</h2>

    <!-- Form Update Profile -->
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
            <input type="text" id="name" name="name"
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                value="{{ old('name', $user->name) }}" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" id="email" name="email"
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input type="password" id="password" name="password"
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none"
                placeholder="Leave blank to keep current password">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
            Save Changes
        </button>
    </form>

    <div class="mt-10 text-center">
        <button
            @click="showDelete = !showDelete"
            class="inline-block text-red-600 hover:text-red-800 font-semibold focus:outline-none"
            type="button"
        >
            Delete Account
        </button>
    </div>

    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6" x-show="showDelete" x-transition>
        @csrf
        @method('DELETE')

        <div class="bg-red-50 border border-red-300 p-4 rounded-md">
            <h4 class="text-lg font-semibold text-red-700 mb-2">Delete Account</h4>
            <p class="text-sm text-red-600">
                Are you sure you want to delete your account? This action is permanent and cannot be undone.
            </p>
        </div>

        <div>
            <label for="password_delete" class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
            <input type="password" id="password_delete" name="password" autocomplete="current-password"
                class="w-full rounded-md border border-gray-300 px-4 py-2 text-gray-900 shadow-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 focus:outline-none"
                required>
        </div>

        <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-md font-semibold hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
            Delete Account
        </button>
    </form>
</div>

@endsection
