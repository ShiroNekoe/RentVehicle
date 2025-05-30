<x-guest-layout>
<div
  class="min-h-screen flex flex-col justify-center items-center px-4"
  style="
    background: linear-gradient(270deg, #316783, #a0c4c7, #548ea6, #2a5368);
    background-size: 800% 800%;
    animation: gradientShift 15s ease infinite;
  ">

  <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8 font-sans">
    <h2 class="text-2xl font-bold text-center text-[#316783] mb-6">Reset Your Password</h2>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
      @csrf

      <!-- Password Reset Token -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <!-- Email Address -->
      <div>
        <x-input-label for="email" :value="__('Email')" class="text-[#316783]" />
        <x-text-input
          id="email"
          class="w-full rounded-full border-2 border-gray-300 px-4 py-2 focus:border-[#316783] focus:ring-[#316783]/50"
          type="email"
          name="email"
          :value="old('email', $request->email)"
          required
          autofocus
          autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div>
        <x-input-label for="password" :value="__('Password')" class="text-[#316783]" />
        <x-text-input
          id="password"
          class="w-full rounded-full border-2 border-gray-300 px-4 py-2 focus:border-[#316783] focus:ring-[#316783]/50"
          type="password"
          name="password"
          required
          autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Confirm Password -->
      <div>
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#316783]" />
        <x-text-input
          id="password_confirmation"
          class="w-full rounded-full border-2 border-gray-300 px-4 py-2 focus:border-[#316783] focus:ring-[#316783]/50"
          type="password"
          name="password_confirmation"
          required
          autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>

      <div class="flex justify-end mt-6">
        <x-primary-button class="btn btn-warning text-white font-semibold px-6 py-2 rounded-md mx-auto block text-center">
          {{ __('Reset Password') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</div>
</x-guest-layout>
