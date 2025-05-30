<x-guest-layout>
<div
  class="min-h-screen flex flex-col justify-center items-center px-4"
  style="
    background: linear-gradient(270deg, #316783, #a0c4c7, #548ea6, #2a5368);
    background-size: 800% 800%;
    animation: gradientShift 15s ease infinite;
  ">

  <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8 font-sans">
    <div class="mb-4 text-sm text-gray-600 text-center font-semibold">
      {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
      @csrf

      <!-- Password -->
      <div>
        <x-input-label for="password" :value="__('Password')" class="text-[#316783] font-semibold" />
        <div class="relative">
          <x-text-input
            id="password"
            class="w-full rounded-full border-2 border-gray-300 px-4 py-2 pr-10
                   focus:border-[#316783] focus:ring focus:ring-[#316783]/50 font-sans"
            type="password"
            name="password"
            required
            autocomplete="current-password" />
        </div>
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <div class="flex justify-end mt-4">
        <button type="submit"
          class="btn btn-warning text-white font-semibold px-6 py-2 rounded-md mx-auto block text-center font-sans hover:bg-yellow-600 transition-colors duration-200">
          {{ __('Confirm') }}
        </button>
      </div>
    </form>
  </div>
</div>
</x-guest-layout>
