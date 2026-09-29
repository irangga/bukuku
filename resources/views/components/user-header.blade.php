{{--
|--------------------------------------------------------------------------
| Komponen Header Navigasi Pengguna
|--------------------------------------------------------------------------
| Bilah navigasi utama yang tampil di seluruh halaman publik BUKUKU.
| Berisi logo, tautan navigasi, keranjang, dan tombol autentikasi.
| Bersifat fixed di bagian atas viewport (z-50).
|--------------------------------------------------------------------------
--}}
<header class="fixed top-0 left-0 right-0 z-50 bg-surface-container-lowest border-b border-outline-variant" x-data="{ mobileMenuOpen: false }">
    <div class="h-16 max-w-7xl mx-auto px-6 flex items-center justify-between gap-space-lg">

        {{-- Logo & Navigasi Utama --}}
        <div class="flex items-center gap-space-lg">
            {{-- Hamburger Menu (Mobile) --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden flex items-center text-on-surface-variant hover:text-on-surface">
                <span class="material-symbols-outlined text-[24px]">menu</span>
            </button>

            {{-- Logo Brand --}}
            <a class="flex items-center gap-space-sm" href="{{ url('/') }}">
                <img alt="Logo Bukuku" class="h-8 w-auto object-contain hidden sm:block" src="https://lh3.googleusercontent.com/aida/AEtjO1WQGXtw1uH8i_6112U1aql_bKeepmvFdayMyDByZ2MQM5_1OG9Y50mNckQ3sxdDbsuQtAdhma_PPLLmUssFGZTWTmtMXA-GAdcvw63TkV0oKW8qNXKIq1TXSS185x_G5tgFPS9-a-zEAkccArRmzKMTNfBMyG3jWPjPvD5veix-mhAoE9UPDPmRHMVDnZypAEbzabxUvPvgLtsNW8QyE0qIbqPKltj7bpsEVq64vJfLQXHkK9zlzJw3lHXh">
                <span class="font-headline-sm text-headline-sm uppercase tracking-tight text-on-surface font-semibold">BUKUKU</span>
            </a>

            {{-- Menu Navigasi Desktop --}}
            <nav class="hidden lg:flex items-center gap-space-lg">
                <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" href="{{ url('/katalog') }}">Katalog</a>
                <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
                <a class="font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface transition-colors" href="{{ url('/kontak') }}">Kontak</a>
            </nav>
        </div>

        {{-- Aksi Pengguna: Keranjang, Login, Daftar, Avatar --}}
        <div class="flex items-center gap-space-sm lg:gap-space-md">
            {{-- Ikon Keranjang Belanja --}}
            @auth
            <a class="flex items-center gap-space-xs px-space-xs lg:px-space-sm py-space-xs text-on-surface-variant hover:text-on-surface transition-colors font-label-md text-label-md" href="{{ url('/keranjang') }}">
                <span class="material-symbols-outlined text-[24px]">shopping_bag</span>
                <span class="hidden lg:inline">Keranjang ({{ \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') }})</span>
                <span class="lg:hidden bg-primary text-on-primary text-[10px] w-4 h-4 flex items-center justify-center rounded-full -ml-3 -mt-3">{{ \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') }}</span>
            </a>
            @else
            <a class="flex items-center gap-space-xs px-space-xs lg:px-space-sm py-space-xs text-on-surface-variant hover:text-on-surface transition-colors font-label-md text-label-md" href="{{ route('login') }}">
                <span class="material-symbols-outlined text-[24px]">shopping_bag</span>
                <span class="hidden lg:inline">Keranjang</span>
            </a>
            @endauth

            {{-- Pembatas Vertikal --}}
            <div class="hidden lg:block h-4 w-px bg-outline-variant"></div>

            @guest
            {{-- Tautan Masuk & Daftar Desktop --}}
            <div class="hidden lg:flex items-center gap-space-sm">
                <a class="font-label-md text-label-md text-on-surface-variant hover:text-on-surface px-space-sm py-space-xs transition-colors" href="{{ url('/login') }}">Masuk</a>
                <a class="font-label-md text-label-md bg-primary text-on-primary px-space-md py-space-xs rounded-lg hover:bg-primary/90 transition-opacity" href="{{ url('/register') }}">Daftar</a>
            </div>
            @endguest

            @auth
            {{-- Dropdown / Avatar Pengguna --}}
            <div class="flex items-center gap-3 relative" x-data="{ openProfile: false }">
                <div class="hidden lg:flex flex-col text-right">
                    <span class="font-label-md text-label-md font-semibold text-on-surface">{{ Auth::user()->name }}</span>
                    @if(Auth::user()->is_admin)
                        <a href="{{ url('/admin/dashboard') }}" class="font-label-sm text-label-sm text-primary hover:underline">Panel Admin</a>
                    @endif
                </div>
                
                <button @click="openProfile = !openProfile" class="w-8 h-8 rounded-full bg-primary flex items-center justify-center shrink-0 text-on-primary font-semibold text-sm focus:outline-none">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </button>
                
                {{-- Dropdown Profile Mobile/Desktop --}}
                <div x-show="openProfile" @click.away="openProfile = false" class="absolute right-0 top-10 mt-2 w-48 bg-surface-container-lowest rounded-md shadow-lg py-1 border border-surface-container-highest flex flex-col lg:hidden z-50">
                    <div class="px-4 py-2 border-b border-surface-container-highest">
                        <span class="block text-sm font-semibold text-on-surface">{{ Auth::user()->name }}</span>
                        @if(Auth::user()->is_admin)
                        <a href="{{ url('/admin/dashboard') }}" class="block text-xs text-primary mt-1">Panel Admin</a>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-error hover:bg-surface-container">Keluar</button>
                    </form>
                </div>

                {{-- Logout Desktop --}}
                <form method="POST" action="{{ route('logout') }}" class="hidden lg:inline-block">
                    @csrf
                    <button type="submit" class="font-label-md text-label-md text-error px-2 py-1 hover:bg-error-container rounded transition-colors" title="Keluar">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </div>

    {{-- Menu Mobile (Dropdown) --}}
    <div x-show="mobileMenuOpen" class="lg:hidden bg-surface-container-lowest border-t border-surface-container-highest">
        <div class="px-4 py-3 space-y-3 flex flex-col">
            <a class="block font-label-md text-label-md text-on-surface-variant hover:text-on-surface" href="{{ url('/katalog') }}">Katalog</a>
            <a class="block font-label-md text-label-md text-on-surface-variant hover:text-on-surface" href="{{ url('/tentang-kami') }}">Tentang Kami</a>
            <a class="block font-label-md text-label-md text-on-surface-variant hover:text-on-surface" href="{{ url('/kontak') }}">Kontak</a>
            @guest
            <div class="border-t border-surface-container-highest pt-3 flex flex-col gap-2">
                <a class="block text-center font-label-md text-label-md text-on-surface border border-outline-variant rounded-lg py-2" href="{{ url('/login') }}">Masuk</a>
                <a class="block text-center font-label-md text-label-md bg-primary text-on-primary rounded-lg py-2" href="{{ url('/register') }}">Daftar</a>
            </div>
            @endguest
        </div>
    </div>
</header>
