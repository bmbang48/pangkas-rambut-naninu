<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Pangkas Rambut Naninu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS.js Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-bg-dark text-white min-h-screen">

    <!-- {{-- NAVIGATION --}} -->
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/5 py-4">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-2xl font-bold tracking-tight">
                    <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain" alt="Logo">
                    Pangkas Rambut Naninu
                </a>

                <div class="hidden md:flex items-center gap-6 ml-4">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-primary' : 'text-gray-400 hover:text-white' }} transition-colors">Pesanan</a>
                    <a href="{{ route('barbers.index') }}" class="text-sm font-medium {{ request()->routeIs('barbers.*') ? 'text-primary' : 'text-gray-400 hover:text-white' }} transition-colors">Barber</a>
                    <a href="{{ route('services.index') }}" class="text-sm font-medium {{ request()->routeIs('services.*') ? 'text-primary' : 'text-gray-400 hover:text-white' }} transition-colors">Layanan</a>
                </div>
            </div>

            <div class="flex items-center gap-6">
                @if(auth()->check())
                <div class="hidden sm:flex items-center gap-3 border-r border-white/10 pr-6 mr-2">
                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="text-sm">
                        <p class="font-bold leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-gray-500 text-xs mt-1">Administrator</p>
                    </div>
                </div>
                
                <button onclick="openLogoutPopup()" class="px-4 py-2 text-sm font-medium text-red-500 hover:bg-red-500/10 rounded-lg transition-colors">
                    Keluar
                </button>
                @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-primary hover:bg-primary/10 rounded-lg transition-colors">
                    Masuk
                </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- {{-- MAIN CONTENT --}} -->
    <main class="max-w-7xl mx-auto px-6 pt-32 pb-20">
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-xl" data-aos="fade-down">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl" data-aos="fade-down">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- {{-- SCRIPTS --}} -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();

        function openLogoutPopup() {
            const width = 600;
            const height = 700;
            const left = (window.innerWidth / 2) - (width / 2);
            const top = (window.innerHeight / 2) - (height / 2);
            
            const popup = window.open(
                "{{ route('auth.logout') }}",
                "Microsoft Login",
                `width=${width},height=${height},top=${top},left=${left},toolbar=no,menubar=no`
            );

            window.addEventListener('message', function(event) {
                if (event.origin !== window.location.origin) return;
                
                if (event.data.type === 'auth_success') {
                    localStorage.removeItem('auth_token');
                    window.location.href = "{{ route('login') }}";
                } else if (event.data.type === 'auth_error') {
                    alert('Kesalahan Otentikasi: ' + event.data.message);
                }
            }, { once: true });
        }
    </script>
    @stack('scripts')
</body>
</html>
