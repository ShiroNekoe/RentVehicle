{{-- resources/views/welcome.blade.php --}}
<x-guest-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <div class="min-h-screen bg-base-100">
        
        <!-- Navbar -->
        <div class="navbar bg-base-100 shadow-md sticky top-0 z-50">
            <div class="flex-1">
                <a class="text-2xl font-bold text-primary">RentalKendaraan</a>
            </div>
            <div class="flex-none space-x-3">
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline btn-primary btn-sm">home</a>
                <a href="{{ route('login') }}" class="btn btn-outline btn-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline btn-primary btn-sm">register</a>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="hero min-h-[80vh] bg-gradient-to-r from-primary to-secondary text-white p-10">
            <div class="hero-content flex-col lg:flex-row-reverse">
                <img src="{{ asset('img/hero-car.png') }}" class="max-w-sm rounded-lg shadow-2xl" alt="Hero Car" />
                <div>
                    <h1 class="text-5xl font-bold">Sewa Kendaraan Impianmu!</h1>
                    <p class="py-6 text-lg">Mobil & motor terbaik, harga terjangkau, proses cepat, dan pembayaran via Midtrans.</p>
                    <a href="{{ route('login') }}" class="btn btn-accent text-white">Sewa Sekarang</a>
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
    </div>
</x-guest-layout>
