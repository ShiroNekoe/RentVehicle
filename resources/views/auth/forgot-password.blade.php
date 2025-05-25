<x-guest-layout>
<div
  class="min-h-screen flex flex-col justify-center items-center px-4"
  style="
    background: linear-gradient(270deg, #316783, #a0c4c7, #548ea6, #2a5368);
    background-size: 800% 800%;
    animation: gradientShift 15s ease infinite;
  ">

  <!-- Form Container -->
  <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8 ">
    <h2 class="text-2xl font-bold text-center text-[#316783] mb-2">Forgot your password?</h2>
    <p class="text-center text-gray-500 font-semibold mb-6">No problem. Just let us know your email and we will send a reset link.</p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6" novalidate>
      @csrf

      <div>
        <x-input-label for="email" :value="__('Email')" class="text-[#316783]" />
        <div class="relative">
          <x-text-input
            id="email"
            class="w-full rounded-full border-2 border-gray-300 px-4 py-2
                   focus:border-[#316783] focus:ring focus:ring-[#316783]/50"
            type="email"
            name="email"
            :value="old('email')"
            required
            autofocus
            autocomplete="email" />
        </div>
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div>
        <button
          type="submit"
          class="btn btn-warning text-white font-semibold px-6 py-2 rounded-md mx-auto block text-center hover:bg-warning/90 transition"
        >
          Reset Link
        </button>
      </div>
    </form>

<div class="text-center mt-6 text-gray-600 text-sm">
  <a href="{{ route('login') }}" class="text-[#316783]  hover:underline">
    Back to <span class="font-bold">login</span>
  </a>
</div>
  </div>
</div>
</x-guest-layout>
