@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12" data-aos="fade-up">
    <div class="mb-6 md:mb-0">
        <h1 class="text-4xl font-bold mb-2 tracking-tight">Kelola <span class="text-primary">Pesanan</span></h1>
        <p class="text-gray-500 font-medium">Pantau semua jadwal dan optimalkan operasional barbershop Anda.</p>
    </div>

    <div class="flex gap-4">
        <div class="glass px-6 py-4 rounded-2xl flex items-center gap-4">
            <div class="text-primary font-bold text-3xl">{{ $bookings->count() }}</div>
            <div class="text-gray-400 text-xs uppercase font-bold tracking-wider leading-tight">Total<br>Pesanan</div>
        </div>
    </div>
</header>

<!-- {{-- BOOKING TABLE --}} -->
<div class="glass rounded-3xl border-white/5 shadow-2x-over overflow-hidden mb-12" data-aos="fade-up" data-aos-delay="100">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-white/[0.02] border-b border-white/5">
                <tr>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Tanggal & Slot</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Pelanggan</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Barber & Layanan</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500">Status</th>
                    <th class="p-6 text-xs uppercase tracking-widest font-bold text-gray-500 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($bookings as $booking)
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    <td class="p-6">
                        <div class="font-bold text-lg leading-none">{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</div>
                        <div class="text-primary/70 font-mono text-sm mt-1 uppercase">{{ $booking->booking_time }}</div>
                    </td>
                    <td class="p-6">
                        <div class="font-bold text-lg leading-none">{{ $booking->customer_name }}</div>
                        <a href="tel:{{ $booking->phone }}" class="text-gray-500 text-sm mt-1 flex items-center gap-2 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            {{ $booking->phone }}
                        </a>
                    </td>
                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center text-primary text-xs font-bold">
                                {{ substr($booking->barber->name ?? '?', 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-sm">{{ $booking->barber->name ?? 'Default' }}</div>
                                <p class="text-gray-500 text-xs">{{ $booking->service->name ?? 'Service' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-6">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                                'completed' => 'bg-green-500/10 text-green-500 border-green-500/20',
                                'canceled' => 'bg-red-500/10 text-red-500 border-red-500/20',
                            ];
                            $currentClass = $statusClasses[$booking->status] ?? 'bg-gray-500/10 text-gray-500 border-gray-500/20';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ $currentClass }}">
                            {{ $booking->status === 'pending' ? 'Menunggu' : ($booking->status === 'completed' ? 'Selesai' : 'Dibatalkan') }}
                        </span>
                    </td>
                    <td class="p-6 text-right">
                        <div class="flex justify-end gap-2">
                            @if($booking->status === 'pending')
                            <button onclick="updateStatus('{{ $booking->id }}', 'completed')" 
                                    class="p-2 text-green-500 hover:bg-green-500/10 rounded-lg transition-all" title="Mark as Completed">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            </button>
                            <button onclick="updateStatus('{{ $booking->id }}', 'canceled')" 
                                    class="p-2 text-yellow-500 hover:bg-yellow-500/10 rounded-lg transition-all" title="Mark as Canceled">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                            @endif
                            
                            <button onclick="deleteBooking('{{ $booking->id }}')" 
                                    class="p-2 text-red-500 hover:bg-red-500/10 rounded-lg transition-all" title="Delete Permanent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-20 text-center text-gray-500 italic">
                        Data tidak ditemukan dalam database Anda.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    async function updateStatus(id, status) {
        let statusText = status === 'completed' ? 'Selesai' : 'Batal';
        if (!confirm('Ubah status pesanan menjadi ' + statusText + '?')) return;
        
        try {
            const res = await fetch(`/bookings/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status })
            });

            if (res.ok) {
                window.location.reload();
            } else {
                alert('Error updating status');
            }
        } catch (err) {
            console.error(err);
            alert('Connection error');
        }
    }

    async function deleteBooking(id) {
        if (!confirm('Tindakan ini tidak bisa dibatalkan. Anda yakin?')) return;

        try {
            const res = await fetch(`/bookings/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            if (res.ok) {
                window.location.reload();
            } else {
                const data = await res.json();
                alert(data.message || 'Gagal menghapus pesanan');
            }
        } catch (err) {
            console.error(err);
            alert('Connection error');
        }
    }
</script>
@endpush
