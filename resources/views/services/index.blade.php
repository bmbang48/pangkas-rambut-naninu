@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12" data-aos="fade-up">
    <div class="mb-6 md:mb-0">
        <h1 class="text-4xl font-bold mb-2 tracking-tight">Kelola <span class="text-primary">Layanan</span></h1>
        <p class="text-gray-500 font-medium">Tentukan jenis layanan potong rambut dan perawatan yang Anda tawarkan.</p>
    </div>

    <a href="{{ route('services.create') }}" class="btn-primary flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Layanan Baru
    </a>
</header>

<div class="glass rounded-3xl border-white/5 shadow-2x-over overflow-hidden mb-12" data-aos="fade-up" data-aos-delay="100">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/[0.02] border-b border-white/5">
                <tr>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Nama Layanan</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Durasi</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Harga</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($services as $service)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="p-6">
                        <div class="font-bold text-lg leading-none">{{ $service->name }}</div>
                    </td>
                    <td class="p-6">
                        <div class="flex items-center gap-2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $service->duration }} Menit
                        </div>
                    </td>
                    <td class="p-6">
                        <div class="text-primary font-bold text-lg">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </div>
                    </td>
                    <td class="p-6 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('services.edit', $service->id) }}" 
                                    class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-all" title="Edit Layanan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus layanan ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Hapus Layanan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center text-gray-500 italic">
                        Layanan tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-white/5">
        {{ $services->links() }}
    </div>
</div>
@endsection
