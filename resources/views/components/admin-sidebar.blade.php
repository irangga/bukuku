{{--
|--------------------------------------------------------------------------
| Komponen Sidebar Navigasi Admin
|--------------------------------------------------------------------------
| Panel navigasi tetap di sisi kiri untuk halaman admin BUKUKU.
| Menggunakan variabel $activePage untuk menandai menu aktif.
| Berisi menu navigasi utama dan profil admin di bagian bawah.
|--------------------------------------------------------------------------
--}}
@php
    $activePage = $activePage ?? 'dashboard';
@endphp

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed left-0 top-0 h-full w-64 bg-surface-container-lowest z-50 flex flex-col justify-between border-r border-surface-container-highest transition-transform duration-300 lg:translate-x-0">
    {{-- Overlay untuk mobile --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 lg:hidden -z-10 w-screen h-screen"></div>
    {{-- Bagian Atas: Brand & Navigasi --}}
    <div class="flex flex-col">
        {{-- Header Sidebar: Logo & Brand --}}
        <div class="h-16 px-space-md flex items-center justify-between border-b border-surface-container-highest">
            <div class="flex items-center gap-space-sm">
                <img alt="Logo BUKUKU" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/AEtjO1XwwX5LaQVsByjtqBruXP7a0Sc-8_m4C2K4pEgUtzyRiJUZOlCP5pVu8pqp1Bt_WS7uPG7L4wKBKgi0-NdZ3l5Tfn_wBeeAJQddXQU2njw5m1cVLupB5xSarbj4LfBaQGjypAE82a83OC-sXjCRhdRrSzBYacAruf_SUul5tYCbBJFd0jgHsNaJlMi28m3ErOMYVibFzujqGDSdl7RgnwOHKKkYupZRxEqozm3mTuCdYTe57kWi8Khyl2nh">
                <div class="flex flex-col">
                    <span class="font-headline-sm text-headline-sm font-bold text-primary tracking-tight leading-none">BUKUKU</span>
                    <span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Panel Admin</span>
                </div>
            </div>
        </div>

        {{-- Menu Navigasi Utama --}}
        <div class="p-space-sm">
            <nav class="flex flex-col gap-space-xs">
                {{-- Dashboard --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg font-label-md text-label-md transition-colors {{ $activePage === 'dashboard' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }}" href="{{ url('/admin/dashboard') }}" @if($activePage === 'dashboard') aria-current="page" @endif>
                    <span class="material-symbols-outlined text-[20px]">grid_view</span>
                    <span>Dashboard</span>
                </a>

                {{-- Kategori --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg font-label-md text-label-md transition-colors {{ $activePage === 'kategori' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }}" href="{{ route('kategori.index') }}" @if($activePage === 'kategori') aria-current="page" @endif>
                    <span class="material-symbols-outlined text-[20px]">category</span>
                    <span>Kategori</span>
                </a>

                {{-- Koleksi Buku --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg font-label-md text-label-md transition-colors {{ $activePage === 'koleksi-buku' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }}" href="{{ route('buku.index') }}" @if($activePage === 'koleksi-buku') aria-current="page" @endif>
                    <span class="material-symbols-outlined text-[20px]">menu_book</span>
                    <span>Koleksi Buku</span>
                </a>

                {{-- Pesanan --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg font-label-md text-label-md transition-colors {{ $activePage === 'pesanan' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }}" href="{{ url('/admin/pesanan') }}" @if($activePage === 'pesanan') aria-current="page" @endif>
                    <span class="material-symbols-outlined text-[20px]">shopping_bag</span>
                    <span>Pesanan</span>
                </a>

                {{-- Data Pelanggan --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg font-label-md text-label-md transition-colors {{ $activePage === 'data-pelanggan' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }}" href="{{ url('/admin/pengguna') }}" @if($activePage === 'data-pelanggan') aria-current="page" @endif>
                    <span class="material-symbols-outlined text-[20px]">group</span>
                    <span>Data Pelanggan</span>
                </a>

                {{-- Pesan Masuk --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg font-label-md text-label-md transition-colors {{ $activePage === 'pesan-masuk' ? 'bg-primary text-on-primary' : 'text-on-surface-variant hover:bg-surface-container hover:text-on-surface' }}" href="{{ url('/admin/pesan-masuk') }}" @if($activePage === 'pesan-masuk') aria-current="page" @endif>
                    <span class="material-symbols-outlined text-[20px]">mail</span>
                    <span>Pesan Masuk</span>
                </a>

                {{-- Pemisah Visual --}}
                <div class="my-space-xs border-t border-surface-container-highest"></div>

                {{-- Tautan ke Toko Publik --}}
                <a class="flex items-center gap-space-sm px-space-sm py-space-sm rounded-lg text-on-surface-variant font-label-md text-label-md hover:bg-surface-container hover:text-on-surface transition-colors" href="{{ url('/') }}">
                    <span class="material-symbols-outlined text-[20px]">storefront</span>
                    <span>Kunjungi Toko</span>
                </a>
            </nav>
        </div>
    </div>

    {{-- Bagian Bawah: Profil Admin & Logout --}}
    <div class="p-space-sm border-t border-surface-container-highest flex flex-col gap-space-xs">
        {{-- Info Profil Admin --}}
        <div class="flex items-center gap-space-sm px-space-sm py-space-xs">
            <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0 text-on-primary font-bold">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex flex-col overflow-hidden">
                <span class="font-label-md text-label-md font-semibold text-on-surface truncate">{{ Auth::user()->name }}</span>
                <span class="font-label-sm text-label-sm text-on-surface-variant truncate">{{ Auth::user()->email }}</span>
            </div>
        </div>

        {{-- Tombol Keluar --}}
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-space-sm px-space-sm py-space-xs rounded-lg text-secondary font-label-md text-label-md hover:bg-secondary-fixed hover:text-on-secondary-fixed transition-colors">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
