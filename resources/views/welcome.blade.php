<x-guest-layout>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Navbar -->
    @include('layouts.navigation') 

<!-- home Section -->
<div class="hero min-h-[70vh] bg-cover bg-center relative" style="color: #316783;">
        <div class="hero-content flex-col lg:flex-row-reverse z-10 px-6 w-full space-y-6 lg:space-y-0 lg:space-x-6">
        <!-- Gambar Mobil -->
      <div class="w-full lg:w-1/2 flex justify-center lg:justify-end mt-12 lg:mt-0" data-aos="fade-right" data-aos-duration="1000">
        <img src="{{ asset('img/car.jpg') }}" class="max-w-full lg:max-w-[90%] max-h-[70vh] object-contain rounded-lg drop-shadow-xl" alt="Hero Car" />
      </div>

        <!-- Teks -->
        <div class="w-full lg:w-1/2 text-left space-y-4" data-aos="fade-left" data-aos-duration="1000">
            <h1 class="text-5xl font-bold leading-tight">
                Ready to Ride? Rent Anytime, Anywhere with <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#81a2e2] to-[#9db4bf] font-extrabold">RentKuy!</span>
            </h1>
            <p class="py-2 text-lg mb-6">Instant car & motorbike rentals at your fingertips.</p>
            <a href="{{ route('login') }}" class="btn btn-warning text-white px-6">Book Now</a>
        </div>
    </div>
</div>

<!-- Filter Search -->
 <section id="service">
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
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center justify-between px-6">
        <!-- Gambar -->
        <div class="w-full lg:w-1/2" data-aos="fade-right">
            <img src="{{ asset('img/vehicle2-image.png') }}" alt="Best Service" class="w-full h-auto object-cover">
        </div>

        <!-- Teks dan iklan layanan -->
        <div class="w-full lg:w-1/2 pl-12 mt-6 lg:mt-0" data-aos="fade-left">
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
<section id="top-rated" class="py-12 px-6">
    <!-- Vehicle of the Month -->
    <div class="text-center mb-4">
        <h4 class="text-lg text-gray-600 mb-6"data-aos="fade-up" data-aos-delay="100">Vehicle of the Month</h4>
    </div>

    <!-- Main Title -->
    <h2 class="text-3xl font-bold text-center mb-10" data-aos="fade-up" data-aos-delay="100">
        Your Next Adventure Starts with a Top Rated Deal
    </h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ([ 
            ['brand' => 'Toyota', 'model' => 'Avanza', 'img' => 'img/contoh1.png', 'seat' => 7, 'type' => 'Mobil', 'transmisi' => 'Manual', 'price' => 'Rp 50.000/day', 'rating' => 4.5],
            ['brand' => 'Honda', 'model' => 'Beat', 'img' => 'img/contoh2.jpg', 'seat' => 2, 'type' => 'Motor', 'transmisi' => 'Automatic', 'price' => 'Rp 25.000/day', 'rating' => 4.7],
            ['brand' => 'Daihatsu', 'model' => 'Sigra', 'img' => 'img/contoh3.jpg', 'seat' => 5, 'type' => 'Mobil', 'transmisi' => 'Automatic', 'price' => 'Rp 45.000/day', 'rating' => 4.6]
        ] as $vehicle)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                <figure>
                    <img src="{{ asset($vehicle['img']) }}" alt="{{ $vehicle['brand'] }} - {{ $vehicle['model'] }}" class="w-full h-64 object-cover" />
                </figure>
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $vehicle['brand'] }} - {{ $vehicle['model'] }}</h3>
                    <p class="text-sm text-gray-600">{{ $vehicle['seat'] }} Seat | {{ $vehicle['transmisi'] }} | {{ $vehicle['type'] }}</p>
                    <p class="text-lg text-gray-900 font-bold mt-2">{{ $vehicle['price'] }}</p>
                    <div class="flex items-center mt-2">
                        <span class="text-yellow-500">
                            @for ($i = 0; $i < floor($vehicle['rating']); $i++)
                                ★
                            @endfor
                            @if ($vehicle['rating'] - floor($vehicle['rating']) >= 0.5)
                                ★
                            @else
                                ☆
                            @endif
                        </span>
                        <span class="ml-2 text-sm text-gray-500">({{ $vehicle['rating'] }})</span>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('login') }}" class="btn btn-warning text-white px-6 py-2 rounded-lg">Sewa Sekarang</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>


<!-- Best Experience Section -->
  <section id="experience" class="py-12 bg-white">
    <div class="max-w-7xl mx-auto text-center px-6">
        <h2 class="text-3xl font-bold text-gray-900 mb-8" data-aos="fade-up">We Are Give You The Best Customer Experience</h2>
        <p class="text-lg text-gray-600 mb-6" data-aos="fade-up" data-aos-delay="100">Best service to make your experience smooth and memorable.</p>

        <!-- Flex container untuk ikon dan gambar -->
        <div class="flex flex-col lg:flex-row justify-center items-center gap-16 relative">

            <!-- Left Icons -->
            <div class="flex flex-col items-center space-y-6 w-full lg:w-1/3" data-aos="fade-right">
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
            <div class="w-full lg:w-1/3 mt-12 lg:mt-0" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('img/vehicle3-image.png') }}" alt="Best Service" class="w-full max-w-sm lg:max-w-[70%] h-auto object-contain mx-auto">
            </div>

            <!-- Right Icons -->
            <div class="flex flex-col items-center space-y-6 w-full lg:w-1/3" data-aos="fade-left">
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

<!-- Footer Section -->
<footer class="bg-[#2C3E50] py-12 text-white">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Logo dan Deskripsi -->
        <div class="flex flex-col lg:flex-row justify-between items-center mb-8">
            <div class="text-center lg:text-left">
                <img src="{{ asset('img/logo.png') }}" alt="RentKuy Logo" class="h-12 w-auto mb-4">
                <p class="text-lg">The best car & motorbike rental service for your next journey.</p>
            </div>

            <!-- Navigasi Footer -->
            <div class="flex flex-col lg:flex-row gap-6 mt-6 lg:mt-0">
                <a href="#home" class="text-white hover:text-gray-200 transition duration-300">Home</a>
                <a href="#services" class="text-white hover:text-gray-200 transition duration-300">Services</a>
                <a href="#about" class="text-white hover:text-gray-200 transition duration-300">About Us</a>
                <a href="#contact" class="text-white hover:text-gray-200 transition duration-300">Contact</a>
            </div>
        </div>

        <!-- Social Media and Contact Info -->
        <div class="flex flex-col lg:flex-row justify-between items-center mb-8">
            <!-- Social Media Icons -->
            <div class="flex gap-6 mb-4 lg:mb-0">
                <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                    <i class="fab fa-facebook-square text-2xl"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                    <i class="fab fa-twitter-square text-2xl"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                    <i class="fab fa-instagram-square text-2xl"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-200 transition duration-300">
                    <i class="fab fa-linkedin text-2xl"></i>
                </a>
            </div>

            <!-- Contact Info -->
            <div class="text-center lg:text-right">
                <p class="text-lg">Call us: <span class="font-semibold">+62 123 456 789</span></p>
                <p class="text-lg">Email: <span class="font-semibold">support@rentkuy.com</span></p>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center mt-8">
            <p class="text-sm">&copy; 2025 RentKuy. All rights reserved.</p>
        </div>
    </div>
</footer>

</x-layouts.landing>
