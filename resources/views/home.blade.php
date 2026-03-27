<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naninu Barbershop</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0f0f0f] text-white">

    <!-- {{-- NAVBAR --}} -->
    <nav class="fixed top-0 w-full bg-black/80 backdrop-blur-md z-50">
        <div class="max-w-7xl mx-auto px-4 py-5 flex justify-between">
            <span class="text-2xl font-bold">Naninu Barbershop</span>

            <div class="hidden md:flex space-x-6">
                <a href="#home">Home</a>
                <a href="#booking">Booking</a>
                <a href="#barbers">Barbers</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>

    <!-- {{-- HERO --}} -->
    <section id="home" class="min-h-screen flex items-center justify-center text-center">
        <div>
            <h1 class="text-5xl font-bold mb-4">
                Premium Haircut Experience
            </h1>
            <p class="text-gray-400 mb-6">
                Book your haircut with professional barbers without waiting.
            </p>

            <button class="px-6 py-3 bg-green-600 rounded">
                Book Appointment
            </button>
        </div>
    </section>

    <!-- {{-- BARBERS --}} -->
    <section id="barbers" class="py-20">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl text-center mb-10">Our Barbers</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

                @php
                $barbers = [
                ['name' => 'Ahmad Rizki', 'experience' => '8 Years', 'specialty' => 'Classic Cuts'],
                ['name' => 'Budi Santoso', 'experience' => '5 Years', 'specialty' => 'Modern Styles'],
                ['name' => 'Dimas Pratama', 'experience' => '6 Years', 'specialty' => 'Beard Expert'],
                ['name' => 'Eko Wijaya', 'experience' => '4 Years', 'specialty' => 'Fade Specialist'],
                ];
                @endphp

                @foreach ($barbers as $barber)
                <div class="bg-[#1a1a1a] p-4 rounded">
                    <h3 class="text-xl">{{ $barber['name'] }}</h3>
                    <p class="text-gray-400">{{ $barber['experience'] }}</p>
                    <p class="text-green-500 text-sm">{{ $barber['specialty'] }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- {{-- SERVICES --}} -->
    <section class="py-20 bg-[#1a1a1a]">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl text-center mb-10">Services</h2>

            @php
            $services = [
            ['name' => 'Haircut', 'duration' => '30 minutes', 'price' => 30000],
            ['name' => 'Haircut + Wash', 'duration' => '45 minutes', 'price' => 40000],
            ['name' => 'Haircut + Beard', 'duration' => '45 minutes', 'price' => 45000],
            ];
            @endphp

            @foreach ($services as $service)
            <div class="flex justify-between bg-[#0f0f0f] p-4 mb-4 rounded">
                <div>
                    <h3>{{ $service['name'] }}</h3>
                    <p class="text-gray-400">{{ $service['duration'] }}</p>
                </div>
                <div>
                    Rp{{ number_format($service['price'], 0, ',', '.') }}
                </div>
            </div>
            @endforeach

        </div>
    </section>

    <!-- {{-- BOOKING --}} -->
    <section id="booking" class="py-20">
        <div class="max-w-xl mx-auto">
            <h2 class="text-3xl text-center mb-6">Booking</h2>

            <form>
                <input type="text" placeholder="Nama"
                    class="w-full p-3 mb-4 bg-[#1a1a1a] rounded">

                <input type="text" placeholder="No HP"
                    class="w-full p-3 mb-4 bg-[#1a1a1a] rounded">

                <textarea placeholder="Notes"
                    class="w-full p-3 mb-4 bg-[#1a1a1a] rounded"></textarea>

                <button class="w-full bg-green-600 py-3 rounded">
                    Book Now
                </button>
            </form>
        </div>
    </section>

    <!-- {{-- FOOTER --}} -->
    <footer id="contact" class="bg-[#1a1a1a] py-10 text-center">
        <p>© 2024 Naninu Barbershop</p>
    </footer>

</body>

</html>