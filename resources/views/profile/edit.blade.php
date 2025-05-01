@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-lg bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Edit Profile</h2>

    <!-- Menampilkan pesan status jika ada -->
    @if(session('status'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-lg mb-4">
            {{ session('status') }}
        </div>
    @endif

    <!-- Form untuk update profil -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Input untuk nama -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="mt-2 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name', $user->name) }}" required>
        </div>

        <!-- Input untuk email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="mt-2 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email', $user->email) }}" required>
        </div>

        <!-- Input untuk nomor telepon -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" id="phone" name="phone" class="mt-2 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('phone', $user->phone) }}">
        </div>

        <!-- Input untuk password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="mt-2 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Leave blank to keep current password">
        </div>

        <!-- Input untuk konfirmasi password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="mt-2 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" >Save Changes</button>
    </form>

    <!-- Form untuk menghapus akun -->
    <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
        @csrf
        @method('DELETE')

        <div class="bg-red-50 p-4 rounded-lg mb-6">
            <h4 class="text-lg font-semibold text-red-700">Delete Account</h4>
            <p class="text-sm text-red-600">Are you sure you want to delete your account? This action is permanent and cannot be undone.</p>
        </div>

        <!-- Input untuk konfirmasi password saat hapus akun -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" id="password" name="password" class="mt-2 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">Delete Account</button>
    </form>
</div>
@endsection
