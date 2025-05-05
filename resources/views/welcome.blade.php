<x-guest-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Navbar -->
    <div class="sticky top-0 z-50 shadow-md bg-gradient-to-r from-[#FFFFFF] to-[#316783]">
        <div class="flex w-full h-16 items-center">
    <!-- Logo Area (kiri) -->
    <div class="flex items-center px-4">
        <a href="#" class="flex items-center space-x-2">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-12 w-13 object-contain">
            <span class="text-[#316783] text-2xl font-extrabold">RentKuy!</span>
        </a>
    </div>
    
        <!-- Menu Area (kanan) -->
        <div class="ml-auto flex space-x-6 px-4">
            <a href="#" class="btn btn-ghost text-white">Home</a>
            <a href="#" class="btn btn-ghost text-white">Service</a>
            <a href="#" class="btn btn-ghost text-white">Top Rated</a>
            <a href="#" class="btn btn-ghost text-white">Experience</a>
            <a href="{{ route('login') }}" class="btn btn-warning text-white">Login</a>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="hero min-h-[70vh] bg-cover bg-center text-white relative" style="background-image: url('{{ asset('img/bg-hero.png') }}')">
    <div class="hero-content flex-col lg:flex-row-reverse z-10 px-6 w-full">
        <!-- Gambar Mobil -->
        <div class="w-full lg:w-1/2 flex justify-end mt-20" data-aos="fade-left" data-aos-duration="1000">
            <img src="{{ asset('img/hero-car.png') }}" class="max-w-3xl rounded-lg drop-shadow-xl" alt="Hero Car" />
        </div>

        <!-- Teks -->
        <div class="w-full lg:w-1/2 text-left space-y-4" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="text-5xl font-bold leading-tight">
                Ready to Ride? Rent Anytime, Anywhere with <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#81a2e2] to-[#9db4bf] font-extrabold">RentKuy!</span>
            </h1>
            <p class="py-2 text-lg mb-6">Instant car & motorbike rentals at your fingertips.</p>
            <a href="{{ route('login') }}" class="btn btn-warning text-white px-6">Book Now</a>
        </div>
    </div>

    <!-- Filter Search -->
    <div class="absolute bottom-[-90px] left-0 right-0 w-full py-6 z-20">
        <div class="max-w-4xl mx-auto bg-white p-6 shadow-lg rounded-lg">
            <form>
                <div class="flex flex-wrap justify-center gap-4">
                    <div class="flex flex-col w-40">
                        <label for="brand" class="text-gray-700 mb-1">SELECT BRAND</label>
                        <select id="brand" class="select select-bordered w-full">
                            <option>All Brand</option>
                            <option>Honda</option>
                            <option>Toyota</option>
                            <option>Suzuki</option>
                        </select>
                    </div>

                    <div class="flex flex-col w-40">
                        <label for="model" class="text-gray-700 mb-1">SELECT MODEL</label>
                        <select id="model" class="select select-bordered w-full">
                            <option>All Models</option>
                            <option>big</option>
                            <option>Medium</option>
                            <option>Small</option>
                        </select>
                    </div>

                    <div class="flex flex-col w-40">
                        <label for="type" class="text-gray-700 mb-1">SELECT TYPE</label>
                        <select id="type" class="select select-bordered w-full">
                            <option>All Type</option>
                            <option>Car</option>
                            <option>Motorbike</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button class="btn btn-warning px-6">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Keunggulan -->
    <section class="py-16 px-6 text-center">
        <h2 class="text-3xl font-bold mb-8">Kenapa Memilih Kami?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card bg-base-200 p-6 shadow-lg">
                <h3 class="text-xl font-semibold">Banyak Pilihan</h3>
                <p>Kendaraan berbagai jenis: besar, kecil, motor, mobil, manual & matic.</p>
            </div>
            <div class="card bg-base-200 p-6 shadow-lg">
                <h3 class="text-xl font-semibold">Pembayaran Mudah</h3>
                <p>Bayar aman & cepat lewat Midtrans.</p>
            </div>
            <div class="card bg-base-200 p-6 shadow-lg">
                <h3 class="text-xl font-semibold">Terpercaya</h3>
                <p>Dipercaya ratusan pelanggan tiap bulan.</p>
            </div>
        </div>
    </section>

    <!-- Kendaraan Populer -->
    <section class="py-12 px-6">
        <h2 class="text-3xl font-bold text-center mb-10">Kendaraan Populer</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ([ 
                ['brand' => 'Toyota', 'model' => 'Avanza', 'img' => 'img/car1.jpg', 'seat' => 7, 'type' => 'Mobil', 'transmisi' => 'Manual'],
                ['brand' => 'Honda', 'model' => 'Beat', 'img' => 'img/motor1.jpg', 'seat' => 2, 'type' => 'Motor', 'transmisi' => 'Automatic'],
                ['brand' => 'Daihatsu', 'model' => 'Sigra', 'img' => 'img/car2.jpg', 'seat' => 5, 'type' => 'Mobil', 'transmisi' => 'Automatic']
            ] as $vehicle)
                <div class="card bg-base-200 shadow-xl">
                    <figure>
                        <img src="{{ asset($vehicle['img']) }}" alt="{{ $vehicle['brand'] }}" class="w-full h-48 object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $vehicle['brand'] }} - {{ $vehicle['model'] }}</h2>
                        <p>{{ $vehicle['seat'] }} Seat | {{ $vehicle['transmisi'] }} | {{ $vehicle['type'] }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Sewa Sekarang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer p-10 bg-base-200 text-base-content">
        <aside>
            <h3 class="text-xl font-bold">RentalKendaraan</h3>
            <p>Kami hadir untuk kebutuhan mobilitasmu<br/>Cepat, aman, terpercaya.</p>
        </aside>
        <nav>
            <h6 class="footer-title">Navigasi</h6> 
            <a class="link link-hover">Tentang Kami</a>
            <a class="link link-hover">Kontak</a>
            <a class="link link-hover">FAQ</a>
        </nav>
    </footer>
</x-layouts.landing>
