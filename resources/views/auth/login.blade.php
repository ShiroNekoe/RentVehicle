<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 px-4">

        <!-- Form Container -->
        <div class="bg-white w-full max-w-md rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-center text-teal-700 mb-6">Welcome!</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Gmail')" />
                    <div class="relative">
                        <x-text-input id="email" class="w-full rounded-full border-2 border-teal-700 px-4 py-2"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-2">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative">
                        <x-text-input id="password" class="w-full rounded-full border-2 border-teal-700 px-4 py-2 pr-10"
                            type="password" name="password" required autocomplete="current-password" />
                        {{-- Optional eye icon here --}}
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Forgot password -->
                <div class="text-right mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-teal-700 font-semibold hover:underline">
                            Forgot <span class="font-bold">Password?</span>
                        </a>
                    @endif
                </div>

                <!-- Login button -->
                <button type="submit" class="btn btn-warning text-white font-semibold px-6 py-2 rounded-full text-center">
                    LOG IN
                </button>
            </form>


            <!-- Sign Up -->
            <div class="text-center mt-6 text-gray-600 text-sm">
                It's easier to <a href="{{ route('register') }}" class="text-teal-700 font-semibold hover:underline">sign up</a> now
            </div>

            <!-- Divider -->
            <div class="divider my-6">OR</div>

            <!-- Google Login -->
            <a href="{{ route('google.login') }}"
                class="btn w-full rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center gap-2 shadow-sm">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 488 512">
                    <path d="M488 261.8C488 403.3 ... " /> <!-- Potong untuk ringkas -->
                </svg>
                <span class="font-semibold text-sm text-gray-700">Continue with Google</span>
            </a>
        </div>
    </div>
</x-guest-layout>
