<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white shadow">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @hasSection('header')
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')
               @livewireScripts
               
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        </main>
    </div>

    <!-- AOS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, 
            easing: 'ease', 
            once: false, 
        });
    </script>



</body>
@stack('scripts')
    @push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    window.addEventListener('midtrans-payment', function (event) {
        snap.pay(event.detail.snapToken, {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
              window.location.href = "/booking/success";

            },
            onPending: function(result) {
                alert("Menunggu pembayaran!");
                window.location.href = "/booking/failed";
            },
            onError: function(result) {
                alert("Terjadi kesalahan pembayaran.");
            },
            onClose: function() {
                alert("Pembayaran dibatalkan.");
            }
        });
    });
</script>
@endpush