<nav x-data="{ open: false }" class="bg-gradient-to-r from-[#FFFFFF] to-[#316783] sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo Area (kiri) -->
            <div class="flex items-center">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-13 object-contain">
                    <span class="text-[#316783] text-2xl font-extrabold">RentKuy!</span>
                </a>
            </div>

<!-- Menu Area (kanan) -->
<div class="hidden sm:flex sm:items-center sm:space-x-8">
    @guest
        <!-- Menu untuk yang belum login -->
        <a href="#" class="text-white">Home</a>
        <a href="#service" class="text-white">Service</a>
        <a href="#top-rated" class="text-white">Top Rated</a>
        <a href="#experience" class="text-white">Experience</a>
        <a href="{{ route('login') }}" class="btn btn-warning text-white">Login</a>
    @else
        <!-- Menu untuk yang sudah login (warna tetap sama dengan yang belum login) -->
        <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
            <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')" class="text-white">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('user.history')" :active="request()->routeIs('user.history')" class="text-white">
                {{ __('History') }}
            </x-nav-link>
        </div>

        <!-- Dropdown -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <!-- Ubah warna latar belakang untuk tombol dropdown -->
                <button class="inline-flex items-center px-3 py-2 btn btn-warning text-white">
                  Hai, {{ Auth::user()->name }} !
                    <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="text-warning">
                    {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-warning">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @endguest
</div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <!-- Menu untuk yang belum login (responsive) -->
                <a href="#" class="block text-white py-2 px-3">Home</a>
                <a href="#service" class="block text-white py-2 px-3">Service</a>
                <a href="#top-rated" class="block text-white py-2 px-3">Top Rated</a>
                <a href="#experience" class="block text-white py-2 px-3">Experience</a>
                <a href="{{ route('login') }}" class="block text-white py-2 px-3">Login</a>
            @else
                <!-- Menu untuk yang sudah login (responsive) -->
                <a href="{{ route('profile.edit') }}" class="block text-white py-2 px-3">{{ __('Profile') }}</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block text-white py-2 px-3">
                        {{ __('Log Out') }}
                    </a>
                </form>
            @endguest
        </div>
    </div>
</nav>
