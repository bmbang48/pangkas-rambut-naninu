@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<header class="mb-12" data-aos="fade-up">
    <a href="{{ route('services.index') }}" class="text-gray-500 hover:text-white transition-colors flex items-center gap-2 mb-4 text-sm font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        Kembali ke Layanan
    </a>
    <h1 class="text-4xl font-bold tracking-tight">Edit <span class="text-primary">Layanan</span></h1>
</header>

<div class="max-w-2xl" data-aos="fade-up" data-aos-delay="100">
    <div class="glass rounded-3xl p-8 border-white/5 shadow-2x-over">
        <form action="{{ route('services.update', $service->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Layanan</label>
                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary/50 transition-colors"
                    placeholder="misal: Potong Rambut Premium">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="duration" class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Durasi (Menit)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $service->duration) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary/50 transition-colors"
                        placeholder="misal: 30">
                    @error('duration')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Harga (Rp)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $service->price) }}" required
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary/50 transition-colors"
                        placeholder="misal: 50000">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit" class="btn-primary flex-1">
                    Perbarui Layanan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
