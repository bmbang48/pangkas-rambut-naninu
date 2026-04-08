<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Naninu Barbershop</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        // Universal Popup Closure: If this page is opened in our auth popup, 
        // notify the parent and close immediately.
        if (window.opener && window.name === "Microsoft Login") {
            window.opener.postMessage({ type: 'auth_success', token: '' }, window.location.origin);
            window.close();
        }
    </script>

    <style>
        .login-gradient {
            background: radial-gradient(circle at 100% 0%, rgba(185, 28, 28, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 0% 100%, rgba(185, 28, 28, 0.15) 0%, transparent 40%);
        }
    </style>
</head>
<body class="bg-bg-dark text-white min-h-screen flex items-center justify-center login-gradient">

    <div class="w-full max-w-md px-6">
        <div class="text-center mb-12">
            <img src="{{ asset('images/logo.png') }}" class="w-16 h-16 object-contain mx-auto mb-4" alt="Logo">
            <span class="text-4xl font-bold tracking-tight mb-2 block">
                Pangkas Rambut <span class="text-primary">Naninu</span>
            </span>
            <p class="text-gray-400">Portal Administrasi</p>
        </div>

        <div class="glass p-10 rounded-3xl border-white/5 shadow-2xl text-center">
            <div class="w-16 h-16 bg-primary/10 rounded-2xl mx-auto mb-8 flex items-center justify-center text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold mb-4">Selamat Datang Kembali</h2>
            <p class="text-gray-400 mb-8 leading-relaxed">Silakan masuk menggunakan Microsoft Entra ID Anda untuk mengakses dasbor manajemen.</p>

            <button onclick="openLoginPopup()" class="btn-primary w-full flex items-center justify-center gap-3">
                <svg class="w-5 h-5" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg"><path d="M11.5 0h11.5v11.5h-11.5z" fill="#f25022"/><path d="M0 0h11.5v11.5h-11.5z" fill="#7fbb00"/><path d="M11.5 11.5h11.5v11.5h-11.5z" fill="#ffb900"/><path d="M0 11.5h11.5v11.5h-11.5z" fill="#00a4ef"/></svg>
                Masuk dengan Microsoft
            </button>

            <script>
                function openLoginPopup() {
                    const width = 600;
                    const height = 700;
                    const left = (window.innerWidth / 2) - (width / 2);
                    const top = (window.innerHeight / 2) - (height / 2);
                    
                    const popup = window.open(
                        "{{ route('auth.redirect') }}",
                        "Microsoft Login",
                        `width=${width},height=${height},top=${top},left=${left},toolbar=no,menubar=no`
                    );

                    // Listener for success message from popup
                    window.addEventListener('message', function(event) {
                        if (event.origin !== window.location.origin) return;
                        if (event.data === 'auth_success') {
                            window.location.href = "{{ route('home') }}";
                        }
                    }, { once: true });
                }
            </script>

            @if(session('error'))
                <div class="mt-6 p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-sm">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-white transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Situs
            </a>
        </div>
    </div>

</body>
</html>
