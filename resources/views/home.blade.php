<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pangkas Rambut Naninu | Your Trusted Neighborhood Barber</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- CSS / Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Universal Popup Closure: If this page is opened in our auth popup, 
        // notify the parent and close immediately.
        if (window.opener && window.name === "Microsoft Login") {
            window.opener.postMessage({ type: 'auth_success', token: '' }, window.location.origin);
            window.close();
        }
    </script>

    <!-- AOS.js Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        .hero-gradient {
            background: radial-gradient(circle at 50% 50%, rgba(185, 28, 28, 0.1) 0%, transparent 50%);
        }
    </style>
</head>

<body class="bg-[#0f0f11] text-white selection:bg-primary/30 selection:text-primary overflow-x-hidden">

    <!-- {{-- BACKGROUND ELEMENTS --}} -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute top-1/4 -left-10 opacity-10 animate-float text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="6" cy="18" r="3"/><path d="M8.12 17.88 12 14"/><path d="M16 8 20 4"/><path d="M17 17l5 5"/><path d="M3 3l5 5"/></svg>
        </div>
        <div class="absolute bottom-1/4 -right-10 opacity-10 animate-float-slow text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M2 14h20"/><path d="M6 14v4a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-4"/><path d="M4 14c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
        </div>
    </div>

    <!-- {{-- NAVBAR --}} -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-300 glass border-b-0" id="navbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <span class="text-2xl font-bold tracking-tight flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10 object-contain" alt="Logo">
                Pangkas Rambut <span class="text-primary">Naninu</span>
            </span>

            <div class="hidden md:flex items-center space-x-6 font-medium">
                <a href="#home" class="hover:text-primary transition-colors">Beranda</a>
                <a href="#barbers" class="hover:text-primary transition-colors">Barber</a>
                <a href="#services" class="hover:text-primary transition-colors">Layanan</a>
                
                @auth
                    <div id="auth-nav-group" class="flex items-center gap-4 border-l border-white/10 pl-6">
                        <div class="text-right">
                            <p class="text-xs text-gray-500 uppercase font-bold leading-none tracking-widest">Masuk sebagai</p>
                            <p id="nav-user-name" class="text-sm font-bold text-white">{{ auth()->user()->name }}</p>
                        </div>
                        <a id="nav-manage" href="{{ route('dashboard') }}" class="px-4 py-2 bg-primary/10 text-primary border border-primary/20 rounded-full hover:bg-primary hover:text-black transition-all text-sm">Kelola</a>
                        <button id="nav-logout" onclick="openLogoutPopup()" class="text-gray-500 hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </button>
                    </div>
                @else
                    <div id="guest-nav-group" class="flex items-center space-x-6 font-medium">
                        <a id="nav-book-now" href="#booking" class="px-5 py-2 bg-primary/10 text-primary border border-primary/20 rounded-full hover:bg-primary hover:text-black transition-all">Pesan Sekarang</a>
                        <button id="nav-login" onclick="openLoginPopup()" class="text-gray-500 hover:text-primary transition-colors font-bold text-sm">Masuk</button>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- {{-- HERO SECTION --}} -->
    <section id="home" class="relative min-h-screen flex items-center justify-center pt-20 hero-gradient">
        <div class="max-w-5xl mx-auto px-6 text-center" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-6xl md:text-8xl font-bold mb-8 leading-tight tracking-tight">
                Kami Potong Rambut, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-red-400">Kami Bangun Kepercayaan Diri</span>
            </h1>
            <p class="text-gray-400 text-xl md:text-2xl mb-12 max-w-2xl mx-auto leading-relaxed">
                Potongan rambut segar, obrolan santai, dan penampilan yang membuat Anda merasa luar biasa.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#booking" class="btn-primary flex items-center gap-2 group">
                    Pesan Pertemuan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                </a>
                <a href="#services" class="px-6 py-3 border border-gray-800 rounded-lg font-bold hover:bg-white/5 transition-all">
                    Lihat Layanan
                </a>
            </div>
        </div>
    </section>

    <!-- {{-- BARBERS SECTION --}} -->
    <section id="barbers" class="py-32 relative bg-[#0c0c0e]">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Barber Kami</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
                <p class="text-gray-400 max-w-xl mx-auto italic">Pengrajin pilihan yang berdedikasi pada detail halus perawatan modern.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach ($barbers as $barber)
                <div class="glass p-6 rounded-2xl border-white/5 card-hover group" data-aos="zoom-in-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="w-24 h-24 bg-primary/10 rounded-full mx-auto mb-6 flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-500 overflow-hidden">
                        @if($barber->photo)
                            <img src="{{ asset('storage/barbers/'.$barber->photo) }}" class="w-full h-full object-cover" alt="{{ $barber->name }}">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-center mb-1">{{ $barber->name }}</h3>
                    <p class="text-primary text-sm font-medium text-center uppercase tracking-widest">{{ $barber->experience }} Tahun Pengalaman</p>
                    <div class="mt-4 pt-4 border-t border-white/5 flex justify-center gap-1">
                        @for($i=0; $i<5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/></svg>
                        @endfor
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- {{-- SERVICES SECTION --}} -->
    <section id="services" class="py-32">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Layanan</h2>
                <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            </div>

            <div class="space-y-4">
                @foreach ($services as $service)
                <div class="flex justify-between items-center glass p-6 rounded-xl border-white/5 card-hover group" data-aos="fade-left" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="flex items-center gap-6">
                        <div class="w-12 h-12 bg-white/5 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-black transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl">{{ $service->name }}</h3>
                            <p class="text-gray-400 flex items-center gap-1 opacity-70">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $service->duration }} menit
                            </p>
                        </div>
                    </div>
                    <div class="text-primary text-2xl font-bold group-hover:scale-110 transition-transform">
                        Rp{{ number_format($service->price, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- {{-- BOOKING SECTION --}} -->
    <section id="booking" class="py-32 bg-[#0c0c0e]">
        <div class="max-w-2xl mx-auto px-6">
            <div class="glass p-8 md:p-12 rounded-3xl border-white/5 shadow-2xl relative overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent"></div>
                
                <h2 class="text-4xl font-bold text-center mb-8">Reservasi Kursi Anda</h2>

                <form id="bookingForm" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400">Nama Anda</label>
                            <input type="text" id="customer_name" placeholder="Nama Lengkap" required
                                class="w-full p-4 bg-[#1a1a1c] border border-white/5 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-400">Nomor Telepon</label>
                            <input type="text" id="phone" placeholder="0812..." required
                                class="w-full p-4 bg-[#1a1a1c] border border-white/5 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Pilih Barber</label>
                        <select id="barber_id" required class="w-full p-4 bg-[#1a1a1c] border border-white/5 rounded-xl text-white appearance-none focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all">
                            <option value="">Pilih barber Anda</option>
                            @foreach($barbers as $barber)
                                <option value="{{ $barber->id }}">{{ $barber->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Pilih Layanan</label>
                        <select id="service_id" required class="w-full p-4 bg-[#1a1a1c] border border-white/5 rounded-xl text-white appearance-none focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all">
                            <option value="">Pilih layanan</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->duration }} mins)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Tanggal</label>
                        <input type="date" id="booking_date" required min="{{ date('Y-m-d') }}"
                            class="w-full p-4 bg-[#1a1a1c] border border-white/5 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all">
                    </div>

                    <div class="space-y-4">
                        <label class="text-sm font-medium text-gray-400 flex justify-between items-center">
                            Slot Waktu Tersedia
                            <span id="slots-loader" class="hidden text-primary animate-pulse text-xs uppercase tracking-widest">Memuat...</span>
                        </label>
                        <input type="hidden" id="booking_time" required>
                        <div id="slots-container" class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                            <!-- Slots will be rendered here -->
                        </div>
                        <p id="no-slots" class="text-center text-gray-500 py-6 glass rounded-xl border-dashed hidden italic">Tidak ada slot tersedia untuk tanggal ini</p>
                        <p id="slots-instruction" class="text-center text-gray-500 py-6 glass rounded-xl border-dashed italic">Pilih Barber, Layanan, dan Tanggal</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-400">Catatan (Opsional)</label>
                        <textarea id="notes" placeholder="Permintaan khusus..."
                            class="w-full p-4 bg-[#1a1a1c] border border-white/5 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/50 transition-all h-24"></textarea>
                    </div>

                    <div id="booking-alert" class="hidden w-full p-4 rounded-xl text-center font-medium shadow-lg animate-pulse"></div>

                    <button type="submit" id="submitBtn" class="w-full btn-primary py-4 text-xl disabled:opacity-50 disabled:cursor-not-allowed group">
                        <span id="btn-text">Konfirmasi Pesanan</span>
                        <div id="btn-loader" class="hidden w-6 h-6 border-2 border-black border-t-transparent rounded-full animate-spin mx-auto"></div>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- {{-- FOOTER --}} -->
    <footer id="contact" class="bg-[#0c0c0e] py-20 text-center border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <span class="text-xl font-bold tracking-tight mb-8 block">
                <img src="{{ asset('images/logo.png') }}" class="w-12 h-12 object-contain mx-auto mb-4" alt="Logo">
                Pangkas Rambut <span class="text-primary">Naninu</span>
            </span>
            <div class="flex justify-center gap-8 mb-12 text-gray-400">
                <a href="#" class="hover:text-primary transition-colors">Instagram</a>
                <a href="#" class="hover:text-primary transition-colors">TikTok</a>
                <a href="#" class="hover:text-primary transition-colors">Maps</a>
            </div>
            <p class="text-gray-500 text-sm">© {{ date('Y') }} Pangkas Rambut Naninu. Dibuat dengan sepenuh hati.</p>
        </div>
    </footer>

    <!-- {{-- WHATSAPP FLOATING BUTTON --}} -->
    <a href="https://wa.me/{{ config('services.whatsapp.number') }}?text=Halo%20Pangkas%20Rambut%20Naninu!%20Saya%20ingin%20memesan%20potong%20rambut" target="_blank"
       class="fixed bottom-8 right-8 bg-primary text-white p-5 rounded-full shadow-2xl hover:scale-110 active:scale-95 transition-all duration-300 z-50 flex items-center justify-center animate-pulse-slow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.789 5.768-.007 1.01.258 1.996.764 2.871l-1.042 3.813 3.896-1.022c.846.46 1.79.702 2.753.702h.005c3.18 0 5.768-2.587 5.789-5.77.01-1.54-.588-2.99-1.68-4.08-1.09-1.09-2.544-1.69-4.085-1.683zm3.176 8.238c-.174.49-.974.946-1.385 1.002-.38.051-.892.176-2.923-.623-2.457-.965-4.032-3.468-4.153-3.633-.122-.165-1.002-1.332-1.002-2.54 0-1.208.636-1.802.861-2.043.226-.242.49-.304.653-.304s.326.002.463.008c.143.007.334-.055.518.39.191.464.653 1.595.714 1.718.061.122.102.264.021.428-.083.164-.122.264-.245.408-.122.143-.257.306-.367.408-.122.122-.25.253-.11.498.138.243.616 1.026 1.328 1.666.918.825 1.688 1.053 1.933 1.176.244.122.387.102.53-.062.142-.163.612-.714.774-.959.163-.245.326-.204.551-.122.224.082 1.428.673 1.672.796.244.122.408.184.469.286.061.102.061.591-.113 1.082zm-3.17-12.41c-5.385 0-9.761 4.376-9.761 9.761 0 1.722.451 3.402 1.309 4.887l-1.854 6.77 6.91-1.815c1.436.787 3.056 1.203 4.708 1.203 5.385 0 9.761-4.376 9.761-9.761 0-5.385-4.376-9.761-9.761-9.761zm0 21.522c-1.464 0-2.899-.39-4.156-1.126l-.298-.175-3.09.811.826-3.013-.193-.306c-.812-1.286-1.242-2.774-1.242-4.316 0-4.28 3.48-7.761 7.76-7.761 4.28 0 7.76 3.481 7.76 7.762s-3.48 7.761-7.76 7.761z"/>
        </svg>
    </a>

    <!-- {{-- SCRIPTS --}} -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            duration: 1000,
            easing: 'ease-out-cubic'
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('py-4', 'bg-bg-dark/95', 'border-white/5');
                nav.classList.remove('py-6', 'glass', 'border-b-0');
            } else {
                nav.classList.remove('py-4', 'bg-bg-dark/95', 'border-white/5');
                nav.classList.add('py-6', 'glass', 'border-b-0');
            }
        });
    </script>

    <script>
        // FORM & SLOT LOGIC
        const barberSelect = document.getElementById('barber_id');
        const serviceSelect = document.getElementById('service_id');
        const dateInput = document.getElementById('booking_date');
        const timeInput = document.getElementById('booking_time');
        const slotsContainer = document.getElementById('slots-container');
        const slotsLoader = document.getElementById('slots-loader');
        const slotsInstruction = document.getElementById('slots-instruction');
        const noSlots = document.getElementById('no-slots');
        const form = document.getElementById('bookingForm');
        const alertBox = document.getElementById('booking-alert');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btn-text');
        const btnLoader = document.getElementById('btn-loader');

        async function fetchSlots() {
            const barberId = barberSelect.value;
            const serviceId = serviceSelect.value;
            const date = dateInput.value;

            if (barberId && serviceId && date) {
                slotsInstruction.classList.add('hidden');
                noSlots.classList.add('hidden');
                slotsContainer.classList.add('opacity-40', 'pointer-events-none');
                slotsLoader.classList.remove('hidden');

                try {
                    const res = await fetch(`/api/available-slots?barber_id=${barberId}&service_id=${serviceId}&date=${date}`);
                    const data = await res.json();
                    
                    renderSlots(data.slots || []);
                } catch (err) {
                    console.error("Fetch error:", err);
                    renderSlots([]);
                } finally {
                    slotsLoader.classList.add('hidden');
                    slotsContainer.classList.remove('opacity-40', 'pointer-events-none');
                }
            } else {
                slotsContainer.innerHTML = '';
                slotsInstruction.classList.remove('hidden');
                noSlots.classList.add('hidden');
            }
        }

        function renderSlots(slots) {
            slotsContainer.innerHTML = '';
            timeInput.value = ''; // Reset selection
            
            if (slots.length === 0) {
                noSlots.classList.remove('hidden');
                return;
            }

            noSlots.classList.add('hidden');
            
            slots.forEach(slot => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.textContent = slot;
                btn.className = 'p-3 bg-[#1a1a1c] border border-white/5 rounded-xl text-sm font-medium hover:border-primary/50 hover:text-primary transition-all duration-200 focus:outline-none';
                
                btn.onclick = () => {
                    // Reset others
                    document.querySelectorAll('.slot-active').forEach(b => {
                        b.classList.remove('slot-active', 'bg-primary', 'text-black', 'border-primary');
                        b.classList.add('bg-[#1a1a1c]', 'border-white/5');
                    });
                    
                    // Select this
                    btn.classList.add('slot-active', 'bg-primary', 'text-black', 'border-primary');
                    btn.classList.remove('bg-[#1a1a1c]', 'border-white/5');
                    timeInput.value = slot;
                };
                
                slotsContainer.appendChild(btn);
            });
        }

        [barberSelect, serviceSelect, dateInput].forEach(el => {
            el.addEventListener('change', fetchSlots);
        });

        async function openLoginPopup() {
            const width = 600;
            const height = 700;
            const left = (window.innerWidth / 2) - (width / 2);
            const top = (window.innerHeight / 2) - (height / 2);
            
            const popup = window.open(
                "{{ route('auth.redirect') }}",
                "Microsoft Login",
                `width=${width},height=${height},top=${top},left=${left},toolbar=no,menubar=no`
            );

            // Listener for success/error message from popup
            const handleMessage = function(event) {
                if (event.origin !== window.location.origin) return;
                
                if (event.data.type === 'auth_success') {
                    if (event.data.token) {
                        localStorage.setItem('auth_token', event.data.token);
                    }
                    window.removeEventListener('message', handleMessage);
                    window.location.reload();
                } else if (event.data.type === 'auth_error') {
                    window.removeEventListener('message', handleMessage);
                    alert('Kesalahan Otentikasi: ' + event.data.message);
                }
            };

            window.addEventListener('message', handleMessage);
        }

        async function openLogoutPopup() {
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
                    window.location.reload();
                }
            }, { once: true });
        }

        // Token-based UI Sync
        function syncAuthUI() {
            const token = localStorage.getItem('auth_token');
            const authGroup = document.getElementById('auth-nav-group');
            const guestGroup = document.getElementById('guest-nav-group');
            
            if (token) {
                if (authGroup) authGroup.classList.remove('hidden');
                if (guestGroup) guestGroup.classList.add('hidden');
            } else {
                if (authGroup) authGroup.classList.add('hidden');
                if (guestGroup) guestGroup.classList.remove('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', syncAuthUI);

        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if(!timeInput.value) {
                alert("Harap pilih slot waktu");
                return;
            }

            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            alertBox.classList.add('hidden');

            const payload = {
                customer_name: document.getElementById('customer_name').value,
                phone: document.getElementById('phone').value,
                barber_id: barberSelect.value,
                service_id: serviceSelect.value,
                booking_date: dateInput.value,
                booking_time: timeInput.value,
                notes: document.getElementById('notes').value,
                status: 'pending'
            };

            try {
                const res = await fetch('/api/bookings', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });
                
                const data = await res.json();
                
                alertBox.classList.remove('hidden');
                if (res.ok) {
                    alertBox.className = 'w-full p-4 rounded-xl text-center bg-primary/20 text-primary border border-primary/50 block';
                    alertBox.textContent = 'Pesanan Dikonfirmasi! Kami menanti kedatangan Anda.';
                    form.reset();
                    renderSlots([]);
                    slotsInstruction.classList.remove('hidden');
                } else {
                    alertBox.className = 'w-full p-4 rounded-xl text-center bg-red-500/20 text-red-400 border border-red-500/50 block';
                    alertBox.textContent = data.message || 'Kesalahan validasi. Harap periksa input Anda.';
                }
            } catch (err) {
                alertBox.classList.remove('hidden');
                alertBox.className = 'w-full p-4 rounded-xl text-center bg-red-500/20 text-red-400 border border-red-500/50 block';
                alertBox.textContent = 'Terjadi kesalahan sistem. Harap coba lagi.';
                console.error(err);
            } finally {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoader.classList.add('hidden');
            }
        });
    </script>

</body>

</html>