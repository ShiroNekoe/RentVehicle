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
            <a href="#" class="btn btn-ghost text-white">Service</a>
            <a href="#" class="btn btn-ghost text-white">Top Rated</a>
            <a href="#" class="btn btn-ghost text-white">Experience</a>
            @guest
            <a href="{{ route('login') }}" class="btn btn-warning text-white">Login</a>
        @endguest
        
        @auth
            <a href="{{ route('user.dashboard') }}" class="btn btn-success text-white">Home</a>
        @endauth
        
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
    <form method="GET" @guest action="{{ route('login') }}" @else action="{{ route('user.dashboard') }}" @endguest>
        <div class="flex flex-wrap md:flex-nowrap justify-center gap-4">
            <div class="w-full md:w-1/3">
                <select name="brand" class="select select-bordered w-full">
                    <option value="">Pilih Brand </option>
                    @foreach (['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha'] as $brand)
                        <option value="{{ $brand }}" @selected(request('brand') == $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="w-full md:w-1/3">
                <select name="model" class="select select-bordered w-full">
                    <option value="">Pilih Model</option>
                    @foreach (['big','medium','small'] as $model)
                        <option value="{{ $model }}" @selected(request('model') == $model)>{{ ucfirst($model) }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="w-full md:w-1/3">
                <select name="type" class="select select-bordered w-full">
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach (['car','motorcycles'] as $type)
                        <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="flex items-end">
                <button class="btn btn-warning px-6">Search</button>
            </div>
        </div>
    </form>
    
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($popularVehicles as $vehicle)
            <div class="card w-full bg-base-100 shadow-xl">
                <figure>
                    <img src="{{ asset('storage/vehicles/' . $vehicle->image_path) }}" class="object-cover h-40 w-full">
                </figure>
                <div class="card-body">
                    <h3 class="text-xl font-bold">{{ $vehicle->name }}</h3>
                    <p class="text-gray-600">{{ $vehicle->type }} - {{ $vehicle->price }} per hari</p>
                    <p class="text-sm text-gray-500">Total Booking: {{ $vehicle->bookings_count }}</p>
                    <div class="card-actions justify-end">
                        @auth
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-warning">Lihat Detail</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning">Lihat Detail</a>
                        @endauth
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>
</section>

<h2 class="text-3xl font-bold text-center mb-10">Review Kendaraan</h2>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($reviews as $review)
        <div class="card w-full bg-base-100 shadow-xl">
            <div class="card-body">
                @if ($review->vehicle) <!-- Check if vehicle exists -->
                    <h3 class="text-xl font-bold">{{ $review->vehicle->vehicle_name }}</h3>
                @else
                    <h3 class="text-xl font-bold">Vehicle Name Not Available</h3>
                @endif
                <p class="text-gray-600">Rating: {{ $review->rating }} / 5</p>
                <p class="text-sm text-gray-500">Diberikan oleh: {{ $review->user->name }}</p>
                <p class="text-sm text-gray-500">Tanggal Review: {{ $review->review_date->format('d M Y') }}</p>
            </div>
        </div>
    @endforeach
</div>




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
