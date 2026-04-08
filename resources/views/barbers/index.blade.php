@extends('layouts.admin')

@section('title', 'Kelola Barber')

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12" data-aos="fade-up">
    <div class="mb-6 md:mb-0">
        <h1 class="text-4xl font-bold mb-2 tracking-tight">Kelola <span class="text-primary">Barber</span></h1>
        <p class="text-gray-500 font-medium">Tambah, perbarui, atau hapus barber dari tim Anda.</p>
    </div>

    <a href="{{ route('barbers.create') }}" class="btn-primary flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Barber Baru
    </a>
</header>

<div class="glass rounded-3xl border-white/5 shadow-2x-over overflow-hidden mb-12" data-aos="fade-up" data-aos-delay="100">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/[0.02] border-b border-white/5">
                <tr>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Foto</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Nama</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Pengalaman</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($barbers as $barber)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="p-6">
                        @if($barber->photo)
                            <img src="{{ asset('storage/barbers/' . $barber->photo) }}" alt="{{ $barber->name }}" class="w-12 h-12 rounded-xl object-cover border border-white/10">
                        @else
                            <div class="w-12 h-12 rounded-xl bg-white/5 flex items-center justify-center text-primary font-bold border border-white/10">
                                {{ substr($barber->name, 0, 1) }}
                            </div>
                        @endif
                    </td>
                    <td class="p-6">
                        <div class="font-bold text-lg leading-none">{{ $barber->name }}</div>
                    </td>
                    <td class="p-6">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-primary/20 bg-primary/10 text-primary">
                            {{ $barber->experience }} Tahun
                        </span>
                    </td>
                    <td class="p-6 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('barbers.edit', $barber->id) }}" 
                                    class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-all" title="Edit Barber">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            
                            <form action="{{ route('barbers.destroy', $barber->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus barber ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Delete Barber">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-20 text-center text-gray-500 italic">
                        Barber tidak ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 border-t border-white/5">
        {{ $barbers->links() }}
    </div>
</div>
@endsection
