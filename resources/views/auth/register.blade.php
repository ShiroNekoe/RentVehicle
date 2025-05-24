<x-guest-layout>
  <div
    class="min-h-screen flex flex-col justify-center items-center px-4"
    style="
      background: linear-gradient(270deg, #316783, #a0c4c7, #548ea6, #2a5368);
      background-size: 800% 800%;
      animation: gradientShift 15s ease infinite;
    "
  >

    <!-- Form Container -->
    <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8">
      <h2 class="text-2xl font-bold text-center text-[#316783] mb-2">Sign Up!</h2>
        <p class="text-center text-gray-500 font-semibold mb-6">To unlock exclusive rides and deals</p>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
          <x-input-label for="name" :value="__('Name')" class="text-[#316783]" />
          <div class="relative">
            <x-text-input
              id="name"
              class="w-full rounded-full border-2 border-gray-300 px-4 py-2
                     focus:border-[#316783] focus:ring focus:ring-[#316783]/50"
              type="text"
              name="name"
              :value="old('name')"
              required
              autofocus
              autocomplete="name"
            />
          </div>
          <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mb-4">
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
              autocomplete="username"
            />
          </div>
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
          <x-input-label for="password" :value="__('Password')" class="text-[#316783]" />
          <div class="relative">
            <x-text-input
              id="password"
              class="w-full rounded-full border-2 border-gray-300 px-4 py-2
                     focus:border-[#316783] focus:ring focus:ring-[#316783]/50"
              type="password"
              name="password"
              required
              autocomplete="new-password"
            />
          </div>
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
          <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#316783]" />
          <div class="relative">
            <x-text-input
              id="password_confirmation"
              class="w-full rounded-full border-2 border-gray-300 px-4 py-2
                     focus:border-[#316783] focus:ring focus:ring-[#316783]/50"
              type="password"
              name="password_confirmation"
              required
              autocomplete="new-password"
            />
          </div>
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
                
        <div class="mt-6 text-center space-y-2">
        <button type="submit" class="btn btn-warning text-white font-semibold px-6 py-2 rounded-md mx-auto">
        {{ __('Register') }}
        </button>

        <a
        class="underline text-sm text-[#316783] hover:text-[#254e58] block"
        href="{{ route('login') }}"
        >
        Already <span class="font-bold">registered</span>?
        </a>



      </form>

    </div>

  </div>

</x-guest-layout>
