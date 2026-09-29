{{--
|--------------------------------------------------------------------------
| Halaman Detail Buku
|--------------------------------------------------------------------------
| Menampilkan informasi lengkap buku individual: sampul, deskripsi,
| harga, tombol beli, dan metadata detail penerbitan.
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'Detail Buku — BUKUKU')

@section('content')
<div class="w-full bg-surface-container-lowest py-space-xl">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">

            {{-- Kolom Kiri: Gambar Sampul Buku --}}
            <div class="lg:col-span-5">
                <div class="w-full aspect-[3/4] bg-surface-container-high rounded-xl overflow-hidden shadow-sm">
                    <img alt="Sampul Buku {{ $book->title }}" class="w-full h-full object-cover" src="{{ $book->cover_image }}">
                </div>
            </div>

            {{-- Kolom Kanan: Detail Buku --}}
            <div class="lg:col-span-7 flex flex-col gap-space-lg">
                {{-- Breadcrumb --}}
                <div class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface-variant">
                    <a class="hover:text-on-surface transition-colors" href="{{ url('/katalog') }}">Katalog</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-on-surface">{{ $book->category->name ?? 'Umum' }}</span>
                </div>

                {{-- Judul & Penulis --}}
                <div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-space-xs">{{ $book->title }}</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">oleh <span class="text-on-surface font-medium">{{ $book->author }}</span></p>
                </div>

                {{-- Badge Kategori --}}
                <div class="flex flex-wrap gap-space-xs">
                    @if($book->category)
                        <span class="px-space-sm py-space-xs bg-surface-container-high rounded-lg font-label-sm text-label-sm text-on-surface">{{ $book->category->name }}</span>
                    @endif
                    <span class="px-space-sm py-space-xs bg-surface-container-high rounded-lg font-label-sm text-label-sm text-on-surface">Buku Cetak</span>
                </div>

                {{-- Harga & Status Stok --}}
                <div class="bg-surface-container-low p-space-lg rounded-xl">
                    <div class="flex items-baseline gap-space-md mb-space-sm">
                        <span class="font-headline-md text-headline-md text-on-surface font-bold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center gap-space-sm mb-space-md">
                        <span class="flex items-center gap-space-xs font-label-sm text-label-sm text-on-surface">
                            <span class="w-2 h-2 rounded-full @if($book->stock > 0) bg-primary @else bg-error @endif"></span>
                            @if($book->stock > 0) Stok Tersedia ({{ $book->stock }}) @else Stok Habis @endif
                        </span>
                        <span class="font-label-sm text-label-sm bg-surface-container-high px-space-sm py-0.5 rounded text-on-surface-variant">
                            COD Tersedia
                        </span>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row gap-space-sm">
                        @auth
                        <form action="{{ url('/keranjang/tambah') }}" method="POST" class="flex-1 flex">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="w-full py-space-sm bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-xs hover:bg-surface-container-highest transition-colors shadow-sm @if($book->stock <= 0) pointer-events-none opacity-50 @endif">
                                <span class="material-symbols-outlined text-body-md">add_shopping_cart</span>
                                Masukkan Keranjang
                            </button>
                        </form>
                        <a href="{{ url('/checkout?book_id=' . $book->id) }}" class="flex-1 py-space-sm bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-xs hover:bg-primary/90 transition-opacity shadow-md @if($book->stock <= 0) pointer-events-none opacity-50 @endif">
                            <span class="material-symbols-outlined text-body-md">shopping_bag</span>
                            Beli Langsung
                        </a>
                        @endauth

                        @guest
                        <a href="{{ route('login') }}" class="flex-1 py-space-sm bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-xs hover:bg-surface-container-highest transition-colors shadow-sm @if($book->stock <= 0) pointer-events-none opacity-50 @endif">
                            <span class="material-symbols-outlined text-body-md">add_shopping_cart</span>
                            Masukkan Keranjang
                        </a>
                        <a href="{{ route('login') }}" class="flex-1 py-space-sm bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-xs hover:bg-primary/90 transition-opacity shadow-md @if($book->stock <= 0) pointer-events-none opacity-50 @endif">
                            <span class="material-symbols-outlined text-body-md">shopping_bag</span>
                            Beli Langsung
                        </a>
                        @endguest
                    </div>
                </div>

                {{-- Sinopsis Buku --}}
                <div>
                    <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-sm">Sinopsis</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        {{ $book->description }}
                    </p>
                </div>

                {{-- Detail Penerbitan --}}
                <div class="bg-surface-container-low p-space-lg rounded-xl">
                    <h3 class="font-label-lg text-label-lg font-semibold text-on-surface mb-space-md">Detail Penerbitan</h3>
                    <div class="grid grid-cols-2 gap-space-sm">
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">Penerbit</span>
                            <span class="font-label-md text-label-md text-on-surface font-medium">{{ $book->publisher ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">ISBN</span>
                            <span class="font-label-md text-label-md text-on-surface font-medium font-mono">{{ $book->isbn ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">Jumlah Halaman</span>
                            <span class="font-label-md text-label-md text-on-surface font-medium">{{ $book->pages ?? '-' }} halaman</span>
                        </div>
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">Tahun Terbit</span>
                            <span class="font-label-md text-label-md text-on-surface font-medium">{{ $book->publication_year ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">Format</span>
                            <span class="font-label-md text-label-md text-on-surface font-medium">Cetak (Fisik)</span>
                        </div>
                        <div>
                            <span class="font-label-sm text-label-sm text-on-surface-variant block">Bahasa</span>
                            <span class="font-label-md text-label-md text-on-surface font-medium">Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
