{{--
|--------------------------------------------------------------------------
| Daftar Pesanan (Admin)
|--------------------------------------------------------------------------
| Menampilkan tabel seluruh pesanan masuk dengan filter status
| (Semua, Menunggu, Dikemas, Dikirim).
|--------------------------------------------------------------------------
--}}
@extends('layouts.admin')

@section('title', 'Kelola Pesanan — BUKUKU Admin')

@php
    $activePage = 'pesanan';
@endphp

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-xl">
    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface mb-space-xs">Daftar Pesanan</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Kelola status pemrosesan dan pengiriman pesanan pelanggan.</p>
    </div>
    <div class="flex items-center gap-space-sm">
        <form action="{{ url()->current() }}" method="GET" class="relative w-64">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID Pesanan / Nama..." class="w-full h-10 pl-10 pr-4 rounded-lg border border-surface-container-highest bg-surface-container-lowest text-body-sm focus:border-primary outline-none transition-colors">
        </form>
        <button class="h-10 px-space-md bg-surface-container-lowest border border-surface-container-highest rounded-lg font-label-md text-label-md text-on-surface flex items-center gap-2 hover:bg-surface-container transition-colors">
            <span class="material-symbols-outlined text-[18px]">filter_list</span> Filter
        </button>
    </div>
</div>

{{-- Filter Status Tabs --}}
<div class="flex items-center gap-space-sm mb-space-md border-b border-surface-container-highest">
    <a href="{{ url('/admin/pesanan') }}{{ request('search') ? '?search='.request('search') : '' }}" class="px-space-md py-space-sm border-b-2 {{ !request('status') ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }} font-label-md text-label-md font-semibold transition-colors">
        Semua Pesanan
    </a>
    <a href="{{ url('/admin/pesanan') }}?status=menunggu{{ request('search') ? '&search='.request('search') : '' }}" class="px-space-md py-space-sm border-b-2 {{ request('status') == 'menunggu' ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }} font-label-md text-label-md font-semibold transition-colors">
        Menunggu Diproses <span class="ml-1 {{ request('status') == 'menunggu' ? 'bg-primary text-on-primary' : 'bg-error-container text-on-error-container' }} px-1.5 py-0.5 rounded-full text-[10px]">{{ $countMenunggu }}</span>
    </a>
    <a href="{{ url('/admin/pesanan') }}?status=dikemas{{ request('search') ? '&search='.request('search') : '' }}" class="px-space-md py-space-sm border-b-2 {{ request('status') == 'dikemas' ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }} font-label-md text-label-md font-semibold transition-colors">
        Sedang Dikemas <span class="ml-1 {{ request('status') == 'dikemas' ? 'bg-primary text-on-primary' : 'bg-surface-container-highest text-on-surface' }} px-1.5 py-0.5 rounded-full text-[10px]">{{ $countDikemas }}</span>
    </a>
    <a href="{{ url('/admin/pesanan') }}?status=dikirim{{ request('search') ? '&search='.request('search') : '' }}" class="px-space-md py-space-sm border-b-2 {{ request('status') == 'dikirim' ? 'border-primary text-primary' : 'border-transparent text-on-surface-variant hover:text-on-surface' }} font-label-md text-label-md font-semibold transition-colors">
        Sedang Dikirim
    </a>
</div>

{{-- Tabel Pesanan --}}
<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-space-md font-semibold w-12"><input type="checkbox" class="rounded border-outline-variant"></th>
                    <th class="p-space-md font-semibold">ID Pesanan & Tgl</th>
                    <th class="p-space-md font-semibold">Pelanggan</th>
                    <th class="p-space-md font-semibold">Item & Total</th>
                    <th class="p-space-md font-semibold">Status Pengiriman</th>
                    <th class="p-space-md font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-highest font-body-sm text-body-sm text-on-surface">
                @forelse($orders as $order)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="p-space-md"><input type="checkbox" class="rounded border-outline-variant"></td>
                    <td class="p-space-md">
                        <div class="flex flex-col">
                            <span class="font-mono font-semibold text-on-surface">{{ $order->order_number }}</span>
                            <span class="text-on-surface-variant font-label-sm">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</span>
                        </div>
                    </td>
                    <td class="p-space-md">
                        <div class="flex flex-col">
                            <span class="font-semibold text-on-surface">{{ $order->shipping_name }}</span>
                            <span class="text-on-surface-variant font-label-sm truncate w-40" title="{{ $order->shipping_address }}">{{ Str::limit($order->shipping_address, 25) }}</span>
                        </div>
                    </td>
                    <td class="p-space-md">
                        <div class="flex flex-col">
                            <span class="text-on-surface">{{ $order->items->count() }} Item</span>
                            <span class="font-semibold text-primary">Rp {{ number_format($order->total_amount, 0, ',', '.') }} ({{ strtoupper($order->payment_method) }})</span>
                        </div>
                    </td>
                    <td class="p-space-md">
                        <div class="flex flex-col items-start gap-1">
                            @if($order->status == 'menunggu')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full font-label-sm text-[11px] bg-error-container text-on-error-container font-semibold">
                                Menunggu Diproses
                            </span>
                            @elseif($order->status == 'dikemas')
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full font-label-sm text-[11px] bg-surface-container-high text-on-surface-variant font-semibold">
                                Sedang Dikemas
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full font-label-sm text-[11px] bg-surface-container text-primary font-semibold">
                                {{ ucfirst($order->status) }}
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="p-space-md text-right">
                        <div class="flex justify-end gap-2">
                            <form action="{{ url('/admin/pesanan/' . $order->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <select name="status" class="px-2 py-1 border border-surface-container-highest rounded text-body-sm outline-none" onchange="this.form.submit()">
                                    <option value="menunggu" {{ $order->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="dikemas" {{ $order->status == 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                    <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                </select>
                            </form>
                            <form action="{{ url('/admin/pesanan/' . $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 border border-surface-container-highest text-error hover:bg-error/10 transition-colors rounded">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-space-lg text-center text-on-surface-variant">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($orders->hasPages())
    <div class="p-space-md border-t border-surface-container-highest flex items-center justify-between">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
