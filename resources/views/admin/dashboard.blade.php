{{--
|--------------------------------------------------------------------------
| Dashboard Utama Admin
|--------------------------------------------------------------------------
| Menampilkan ringkasan metrik (Pesanan, Pelanggan, Pendapatan) dan
| tabel pesanan terbaru. Menggunakan layout admin.
|--------------------------------------------------------------------------
--}}
@extends('layouts.admin')

@section('title', 'Dashboard Utama — BUKUKU Admin')

@php
    $activePage = 'dashboard';
@endphp

@section('content')
<div class="mb-space-xl">
    <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface mb-space-xs">Dashboard</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Ringkasan performa dan aktivitas toko BUKUKU hari ini.</p>
</div>

{{-- Kartu Metrik Ringkasan --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-lg mb-space-xl">
    {{-- Metrik 1: Total Pesanan Baru --}}
    <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-surface-container-highest">
        <div class="flex items-start justify-between mb-space-md">
            <div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[24px]">shopping_bag</span>
            </div>
        </div>
        <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Pesanan (Hari Ini)</h3>
        <p class="font-headline-lg text-headline-lg font-bold text-on-surface">{{ number_format($metrics['total_orders']) }}</p>
    </div>

    {{-- Metrik 2: Total Pendapatan COD --}}
    <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-surface-container-highest">
        <div class="flex items-start justify-between mb-space-md">
            <div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[24px]">payments</span>
            </div>
        </div>
        <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Pendapatan (Hari Ini)</h3>
        <p class="font-headline-lg text-headline-lg font-bold text-on-surface">Rp {{ number_format($metrics['total_revenue'], 0, ',', '.') }}</p>
    </div>

    {{-- Metrik 3: Pelanggan Baru --}}
    <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-surface-container-highest">
        <div class="flex items-start justify-between mb-space-md">
            <div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[24px]">group_add</span>
            </div>
        </div>
        <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Pelanggan Aktif</h3>
        <p class="font-headline-lg text-headline-lg font-bold text-on-surface">{{ number_format($metrics['new_users']) }}</p>
    </div>

    {{-- Metrik 4: Status Inventaris --}}
    <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm border border-surface-container-highest">
        <div class="flex items-start justify-between mb-space-md">
            <div class="w-12 h-12 rounded-lg bg-surface-container-low flex items-center justify-center">
                <span class="material-symbols-outlined text-primary text-[24px]">inventory_2</span>
            </div>
        </div>
        <h3 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Total Judul Buku</h3>
        <p class="font-headline-lg text-headline-lg font-bold text-on-surface">{{ number_format($metrics['total_books']) }}</p>
    </div>
</div>

{{-- Tabel Pesanan Terbaru --}}
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest overflow-hidden">
    {{-- Header Tabel --}}
    <div class="p-space-lg border-b border-surface-container-highest flex items-center justify-between">
        <div>
            <h2 class="font-headline-sm text-headline-sm font-semibold text-on-surface">Pesanan Terbaru</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">5 pesanan terakhir yang perlu diproses.</p>
        </div>
        <a href="{{ url('/admin/pesanan') }}" class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1">
            Lihat Semua <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>

    {{-- Konten Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-space-md font-semibold">ID Pesanan</th>
                    <th class="p-space-md font-semibold">Pelanggan</th>
                    <th class="p-space-md font-semibold">Tanggal & Waktu</th>
                    <th class="p-space-md font-semibold">Total (COD)</th>
                    <th class="p-space-md font-semibold">Status</th>
                    <th class="p-space-md font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-highest font-body-sm text-body-sm text-on-surface">
                @forelse($recent_orders as $order)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="p-space-md font-mono font-medium">{{ $order->order_number }}</td>
                    <td class="p-space-md">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-surface">{{ $order->shipping_name }}</span>
                            <span class="text-on-surface-variant font-label-sm">{{ $order->shipping_phone }}</span>
                        </div>
                    </td>
                    <td class="p-space-md text-on-surface-variant">{{ $order->created_at->translatedFormat('d M Y, H:i') }} WIB</td>
                    <td class="p-space-md font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="p-space-md">
                        @if($order->status == 'menunggu')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-error-container text-on-error-container font-semibold">
                            Menunggu Diproses
                        </span>
                        @elseif($order->status == 'dikemas')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-surface-container-high text-on-surface-variant font-semibold">
                            Sedang Dikemas
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-surface-container text-primary font-semibold">
                            {{ ucfirst($order->status) }}
                        </span>
                        @endif
                    </td>
                    <td class="p-space-md text-right">
                        <button class="p-2 text-on-surface-variant hover:text-primary transition-colors rounded-lg hover:bg-surface-container" title="Detail">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-space-lg text-center text-on-surface-variant">Belum ada pesanan terbaru hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
