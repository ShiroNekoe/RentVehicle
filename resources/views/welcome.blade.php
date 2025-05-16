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
            @guest
                <a href="{{ route('login') }}" class="btn btn-warning text-white">Login</a>
            @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-success text-white">Home</a>
            @endguest

        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="hero min-h-[70vh] bg-cover bg-center text-white relative" style="background-image: url('{{ asset('img/bg-hero.png') }}')">
    <div class="hero-content flex-col lg:flex-row-reverse z-10 px-6 w-full">
        <!-- Gambar Mobil -->
        <div class="w-full lg:w-1/2 flex justify-end mt-20" data-aos="fade-left" data-aos-duration="1000">
            <img src="{{ asset('img/hero-car.png') }}" class="max-w-2xl max-h-[70vh] object-contain rounded-lg drop-shadow-xl" alt="Hero Car" />
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
</div>

<!-- Filter Search -->
<form method="GET" @guest action="{{ route('login') }}" @else action="{{ route('user.dashboard') }}" @endguest>
    <div class="bg-white shadow-lg rounded-lg p-6 mx-auto max-w-4xl mt-12">
        <div class="flex justify-center gap-6">
            <!-- Brand -->
            <div class="w-full md:w-1/4">
                <select name="brand" class="select select-bordered w-full">
                    <option value="">Pilih Brand</option>
                    @foreach (['Honda','Toyota','Daihatsu','Suzuki','Mitsubishi','Yamaha'] as $brand)
                        <option value="{{ $brand }}" @selected(request('brand') == $brand)>{{ $brand }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Model -->
            <div class="w-full md:w-1/4">
                <select name="model" class="select select-bordered w-full">
                    <option value="">Pilih Model</option>
                    @foreach (['big','medium','small'] as $model)
                        <option value="{{ $model }}" @selected(request('model') == $model)>{{ ucfirst($model) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Type -->
            <div class="w-full md:w-1/4">
                <select name="type" class="select select-bordered w-full">
                    <option value="">Pilih Tipe Kendaraan</option>
                    @foreach (['car','motorcycles'] as $type)
                        <option value="{{ $type }}" @selected(request('type') == $type)>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Button -->
            <div class="w-full md:w-1/4 flex items-end justify-center">
                <button class="btn btn-warning text-white px-6">Search</button>
            </div>
        </div>
    </div>
</form>

<!-- How it Works Section -->
<div class="py-12 bg-white-100">
    <div class="max-w-7xl mx-auto text-center px-6">
        <h2 class="text-lg font-semibold text-gray-600 mb-2">How it Works</h2>
        <p class="text-3xl font-bold text-gray-900 mb-6">Getting Started with RentKuy! is Easy</p>

        <div class="flex justify-center items-start gap-x-12 md:gap-x-20">
            <!-- Step 1 -->
            <div class="text-center max-w-xs relative" data-aos="fade-up">
                <div class="bg-transparent p-6 rounded-full mb-4 mx-auto transition-transform transform hover:scale-110 duration-300 ease-in-out">
                    <img src="{{ asset('img/location-icon.png') }}" alt="Choose a location" class="w-16 h-16 mx-auto">
                </div>
                <p class="font-bold text-xl text-gray-800">Choose a location</p>
                <p class="text-sm text-gray-500">Select where you want to pick up your ride.</p>
            </div>

            <!-- Step 2 -->
            <div class="text-center max-w-xs relative" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-transparent p-6 rounded-full mb-4 mx-auto transition-transform transform hover:scale-110 duration-300 ease-in-out">
                    <img src="{{ asset('img/calendar-icon.png') }}" alt="Pick-up date" class="w-16 h-16 mx-auto">
                </div>
                <p class="font-bold text-xl text-gray-800">Pick-up date</p>
                <p class="text-sm text-gray-500">Choose the date and time that fits your schedule.</p>
            </div>

            <!-- Step 3 -->
            <div class="text-center max-w-xs relative" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-transparent p-6 rounded-full mb-4 mx-auto transition-transform transform hover:scale-110 duration-300 ease-in-out">
                    <img src="{{ asset('img/car-icon.png') }}" alt="Book your car" class="w-16 h-16 mx-auto">
                </div>
                <p class="font-bold text-xl text-gray-800">Book your car</p>
                <p class="text-sm text-gray-500">Confirm your ride and get ready to go.</p>
            </div>
        </div>
    </div>
</div>

 <!-- Best Service Section -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6">
        <div class="w-full" data-aos="fade-right">
            <img src="{{ asset('img/vehicle2-image.png') }}" alt="Best Service" class="w-full h-auto object-cover">
        </div>

        <!-- Teks dan iklan layanan -->
        <div class="w-full lg:w-2/3 pl-12" data-aos="fade-left">
            <h2 class="text-3xl font-bold text-gray-900">Everything You Need for a Better Rental Experience</h2>
            <p class="text-lg text-gray-600">Best service to make your experience smooth and memorable.</p>

            <div class="mt-6 space-y-4">
                <div class="flex items-start space-x-4">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="Deals" class="w-12 h-12"> 
                    <div>
                        <p class="text-lg font-semibold text-gray-800">Deals for every budget</p>
                        <p class="text-lg text-gray-800">We have best deals, matched just for you.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <img src="{{ asset('img/price-icon.png') }}" alt="Best Price" class="w-12 h-12"> 
                    <div>
                        <p class="text-lg font-semibold text-gray-800">Best price guaranteed</p>
                        <p class="text-lg text-gray-800">We match you with the best rates always.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <img src="{{ asset('img/support-icon.png') }}" alt="Support" class="w-12 h-12"> 
                    <div>
                        <p class="text-lg font-semibold text-gray-800">Support 24/7</p>
                        <p class="text-lg text-gray-800">We're here for you anytime, day or night.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<!-- Best Experience Section -->
<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto text-center px-6">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">We Are Give You The Best Customer Experience</h2>
        <p class="text-lg text-gray-600 mb-12">Best service to make your experience smooth and memorable.</p>

        <!-- Flex container untuk ikon dan gambar -->
        <div class="flex justify-center items-center gap-16 relative">

            <!-- Left Icons -->
            <div class="flex flex-col items-center space-y-6 w-1/3">
                <div class="service-item left-service relative flex flex-col items-center">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="Roadside Assistance 24/7" class="w-12 h-12 mb-4">
                    <p class="text-lg text-gray-800">Roadside Assistance 24/7</p>
                    <div class="line left-line mt-2 w-16 h-1 bg-orange-500"></div> <!-- Garis -->
                </div>

                <div class="service-item left-service relative flex flex-col items-center">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="Most Flexible Payment Plans" class="w-12 h-12 mb-4">
                    <p class="text-lg text-gray-800">Most Flexible Payment Plans</p>
                    <div class="line left-line mt-2 w-16 h-1 bg-orange-500"></div> <!-- Garis -->
                </div>

                <div class="service-item left-service relative flex flex-col items-center">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="Your Choice of Mechanic" class="w-12 h-12 mb-4">
                    <p class="text-lg text-gray-800">Your Choice of Mechanic</p>
                    <div class="line left-line mt-2 w-16 h-1 bg-orange-500"></div> <!-- Garis -->
                </div>
            </div>

            <!-- Gambar Mobil -->
            <div class="w-full lg:w-1/3 mt-12">
                <img src="{{ asset('img/vehicle3-image.png') }}" alt="Best Service" class="w-full h-auto object-cover mx-auto">
            </div>

            <!-- Right Icons -->
            <div class="flex flex-col items-center space-y-6 w-1/3">
                <div class="service-item right-service relative flex flex-col items-center">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="Easier Rent On Your Budget" class="w-12 h-12 mb-4">
                    <p class="text-lg text-gray-800">Easier Rent On Your Budget</p>
                    <div class="line right-line mt-2 w-16 h-1 bg-orange-500"></div> <!-- Garis -->
                </div>
                
                <div class="service-item right-service relative flex flex-col items-center">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="Competitive Pricing" class="w-12 h-12 mb-4">
                    <p class="text-lg text-gray-800">Competitive Pricing</p>
                    <div class="line right-line mt-2 w-16 h-1 bg-orange-500"></div> <!-- Garis -->
                </div>

                <div class="service-item right-service relative flex flex-col items-center">
                    <img src="{{ asset('img/deal-icon.png') }}" alt="The Best Extended Auto Warranties" class="w-12 h-12 mb-4">
                    <p class="text-lg text-gray-800">The Best Extended Auto Warranties</p>
                    <div class="line right-line mt-2 w-16 h-1 bg-orange-500"></div> <!-- Garis -->
                </div>
            </div>

        </div>
    </div>
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
