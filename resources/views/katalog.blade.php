{{--
|--------------------------------------------------------------------------
| Halaman Beranda / Katalog Buku
|--------------------------------------------------------------------------
| Halaman utama toko BUKUKU yang menampilkan hero section, koleksi
| buku pilihan dengan grid kartu, dan bilah filter/pencarian.
| Menggunakan layout app (dengan header & footer).
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'BUKUKU — Toko Buku Daring Minimalis Indonesia')
@section('meta_description', 'Temukan koleksi buku berkualitas dari penerbit resmi Indonesia. Belanja mudah dengan opsi Bayar di Tempat (COD) ke seluruh Nusantara.')

@section('content')
{{-- Judul Halaman Katalog --}}
<section class="w-full bg-surface-container-lowest pt-space-lg pb-space-sm">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="font-headline-md text-headline-md text-primary tracking-tight mb-2">Katalog Buku</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Jelajahi semua koleksi buku kami yang tersedia.</p>
    </div>
</section>

{{-- Filter & Pencarian --}}
<section class="w-full bg-surface-container-low py-space-md">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-space-md">
            {{-- Pencarian --}}
            <form action="{{ url()->current() }}" method="GET" class="relative flex-1 max-w-md">
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-body-lg">search</span>
                <input name="search" class="w-full h-10 pl-10 pr-4 rounded-lg bg-surface-container-lowest text-on-surface font-body-sm text-body-sm outline-none placeholder:text-outline-variant" id="book-search" placeholder="Cari judul buku, penulis, atau penerbit..." type="text" value="{{ request('search') }}">
            </form>

            {{-- Filter Kategori --}}
            <div class="flex flex-wrap items-center gap-space-sm">
                <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">Filter:</span>
                <a href="{{ url()->current() }}{{ request('search') ? '?search='.request('search') : '' }}" class="px-space-md py-space-xs rounded-lg {{ !request('kategori') ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container' }} font-label-md text-label-md transition-colors">Semua</a>
                @foreach($categories as $cat)
                    <a href="{{ url()->current() }}?kategori={{ $cat->slug }}{{ request('search') ? '&search='.request('search') : '' }}" class="px-space-md py-space-xs rounded-lg {{ request('kategori') == $cat->slug ? 'bg-primary text-on-primary' : 'bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container' }} font-label-md text-label-md transition-colors">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Grid Kartu Buku --}}
<section class="w-full bg-surface-container-lowest py-space-xl">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-space-md">

            @forelse($books as $book)
            <a class="group flex flex-col bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-md transition-shadow" href="{{ url('/buku/' . $book->slug) }}">
                <div class="w-full aspect-[3/4] bg-surface-container-high overflow-hidden">
                    <img alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="{{ $book->cover_image }}">
                </div>
                <div class="p-space-sm flex flex-col gap-space-xs">
                    <h3 class="font-label-lg text-label-lg font-semibold text-on-surface line-clamp-1">{{ $book->title }}</h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1">{{ $book->author }}</p>
                    <div class="flex items-center justify-between mt-space-xs">
                        <span class="font-label-lg text-label-lg font-bold text-on-surface">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        <span class="font-label-sm text-label-sm bg-surface-container-high px-space-xs py-0.5 rounded text-on-surface-variant">COD</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">book</span>
                <p>Belum ada buku di katalog ini.</p>
            </div>
            @endforelse

        </div>
        
        {{-- Paginasi --}}
        @if($books->hasPages())
        <div class="mt-space-xl flex justify-center">
            {{ $books->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
