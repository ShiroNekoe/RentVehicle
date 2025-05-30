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
    <h2 class="text-2xl font-bold text-center text-[#316783] mb-2">Welcome!</h2>
    <p class="text-center text-gray-500 font-semibold mb-6">Find your perfect ride</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

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
            autofocus
            autocomplete="username" />
    </div>
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mb-2">
    <x-input-label for="password" :value="__('Password')" class="text-[#316783]" />
    <div class="relative">
        <x-text-input
            id="password"
            class="w-full rounded-full border-2 border-gray-300 px-4 py-2 pr-10
                   focus:border-[#316783] focus:ring focus:ring-[#316783]/50"
            type="password"
            name="password"
            required
            autocomplete="current-password" />
        {{-- Optional eye icon here --}}
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>


                <!-- Forgot password -->
                <div class="text-right mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#316783] font-semibold hover:underline">
                            Forgot <span class="font-bold">Password?</span>
                        </a>
                    @endif
                </div>

                <!-- lOGIN -->
                <button type="submit"
                    class="btn btn-warning text-white font-semibold px-6 py-2 rounded-md mx-auto block text-center">
                    LOG IN
                </button>



            <!-- Sign Up -->
            <div class="text-center mt-6 text-gray-600 text-sm">
                It's easier to <a href="{{ route('register') }}" class="text-[#316783] font-semibold hover:underline">sign up</a> now
            </div>

            <!-- Divider -->
            <div class="divider my-6">OR</div>

            <!-- Google Login -->
            <a href="{{ route('google.login') }}"
            class="btn w-full rounded-md bg-gray-100 hover:bg-gray-200 flex items-center justify-center gap-2 shadow-sm text-gray-700 font-semibold text-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 488 512">
                    <path d="M488 261.8C488 403.3 ... " /> 
                </svg>
                <span>Continue with Google</span>
            </a>

</x-guest-layout>
