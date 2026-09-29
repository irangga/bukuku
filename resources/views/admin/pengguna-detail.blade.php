@extends('layouts.admin')
@php
    $activePage = 'data-pelanggan';
@endphp

@section('title', 'Detail Pelanggan — Admin')

@section('content')
{{-- Breadcrumb & Aksi Kembali --}}
<div class="mb-space-md flex items-center justify-between">
    <a href="{{ url('/admin/pengguna') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Data Pelanggan
    </a>
</div>

{{-- Header Halaman --}}
<div class="mb-space-lg flex justify-between items-end">
    <div>
        <h1 class="font-headline-md text-headline-md text-on-surface font-semibold mb-1">Profil Pelanggan</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Detail informasi akun dan riwayat pesanan.</p>
    </div>
    
    <form action="{{ url('/admin/pengguna/' . $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini beserta semua data pesanannya?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="flex items-center gap-2 px-space-md py-space-xs bg-error-container text-on-error-container rounded-lg font-label-md text-label-md hover:opacity-90 transition-opacity">
            <span class="material-symbols-outlined text-[18px]">delete</span>
            Hapus Pelanggan
        </button>
    </form>
</div>

{{-- Kartu Info Pelanggan --}}
<div class="bg-surface-container-lowest border border-surface-container-highest rounded-xl p-space-lg mb-space-xl flex items-center gap-space-lg">
    <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center shrink-0 text-on-primary font-headline-md text-headline-md font-bold">
        {{ substr($user->name, 0, 1) }}
    </div>
    <div>
        <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">{{ $user->name }}</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mb-2">{{ $user->email }}</p>
        <div class="flex items-center gap-4 text-on-surface-variant font-label-sm text-label-sm">
            <span class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">calendar_today</span>
                Bergabung sejak {{ $user->created_at->translatedFormat('d F Y') }}
            </span>
            <span class="flex items-center gap-1">
                <span class="material-symbols-outlined text-[16px]">shopping_bag</span>
                Total {{ $user->orders->count() }} Pesanan
            </span>
        </div>
    </div>
</div>

{{-- Tabel Riwayat Pesanan --}}
<h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-md">Riwayat Pesanan</h2>
<div class="bg-surface-container-lowest border border-surface-container-highest rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left font-body-sm text-body-sm text-on-surface">
            <thead class="bg-surface-container-low font-label-md text-label-md text-on-surface-variant border-b border-surface-container-highest">
                <tr>
                    <th class="px-space-md py-space-sm font-semibold">ID Pesanan</th>
                    <th class="px-space-md py-space-sm font-semibold">Tanggal</th>
                    <th class="px-space-md py-space-sm font-semibold">Detail Buku</th>
                    <th class="px-space-md py-space-sm font-semibold">Total Harga</th>
                    <th class="px-space-md py-space-sm font-semibold">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-highest">
                @forelse($user->orders as $order)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="p-space-md font-semibold text-primary">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td class="p-space-md text-on-surface-variant">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</td>
                    <td class="p-space-md">
                        <ul class="list-disc pl-4 text-xs text-on-surface-variant">
                            @foreach($order->items as $item)
                                <li>{{ $item->book->title }} (x{{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="p-space-md font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="p-space-md">
                        @if($order->status == 'menunggu')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Menunggu</span>
                        @elseif($order->status == 'dikemas')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Dikemas</span>
                        @elseif($order->status == 'dikirim')
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Dikirim</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-space-xl text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">shopping_bag</span>
                        <p>Pelanggan belum membuat pesanan apapun.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
