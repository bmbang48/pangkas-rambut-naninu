@extends('layouts.admin')

@section('title', 'Tambah Barber Baru')

@section('content')
<header class="mb-12" data-aos="fade-up">
    <a href="{{ route('barbers.index') }}" class="text-gray-500 hover:text-white transition-colors flex items-center gap-2 mb-4 text-sm font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        Kembali ke Daftar Barber
    </a>
    <h1 class="text-4xl font-bold tracking-tight">Tambah <span class="text-primary">Barber Baru</span></h1>
</header>

<div class="max-w-2xl" data-aos="fade-up" data-aos-delay="100">
    <div class="glass rounded-3xl p-8 border-white/5 shadow-2x-over">
        <form action="{{ route('barbers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="name" class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary/50 transition-colors"
                    placeholder="Masukkan nama barber">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="experience" class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Tahun Pengalaman</label>
                <input type="number" name="experience" id="experience" value="{{ old('experience') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary/50 transition-colors"
                    placeholder="misal: 5">
                @error('experience')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="photo" class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Foto Barber</label>
                <div class="flex items-center gap-4">
                    <div id="image-preview-container" class="hidden">
                        <img id="image-preview" src="#" alt="Preview" class="w-20 h-20 rounded-xl object-cover border border-white/10">
                    </div>
                    <div class="flex-1">
                        <input type="file" name="photo" id="photo" accept="image/*"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-sm text-gray-400 file:mr-4 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-all cursor-pointer">
                        <p class="text-gray-500 text-xs mt-2">Rekomendasi: Rasio kotak, maks 2MB.</p>
                    </div>
                </div>
                @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit" class="btn-primary w-full">
                    Buat Profil Barber
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('photo').onchange = evt => {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('image-preview-container').classList.remove('hidden');
            document.getElementById('image-preview').src = URL.createObjectURL(file);
        }
    }
</script>
@endpush
