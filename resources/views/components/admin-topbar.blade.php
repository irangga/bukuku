{{--
|--------------------------------------------------------------------------
| Komponen Top Bar Admin
|--------------------------------------------------------------------------
| Bilah atas tetap (fixed) untuk panel admin. Menampilkan breadcrumb
| navigasi, indikator status sistem, dan avatar pengguna admin.
|--------------------------------------------------------------------------
--}}
<header class="fixed top-0 left-0 lg:left-64 right-0 h-16 bg-surface-container-lowest z-40 border-b border-surface-container-highest flex items-center justify-between px-space-md lg:px-space-lg">

    {{-- Breadcrumb Navigasi & Hamburger --}}
    <div class="flex items-center gap-space-sm">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden flex items-center justify-center text-on-surface-variant hover:text-on-surface mr-2">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <img alt="Logo BUKUKU" class="h-8 w-auto object-contain hidden sm:block" src="https://lh3.googleusercontent.com/aida/AEtjO1XwwX5LaQVsByjtqBruXP7a0Sc-8_m4C2K4pEgUtzyRiJUZOlCP5pVu8pqp1Bt_WS7uPG7L4wKBKgi0-NdZ3l5Tfn_wBeeAJQddXQU2njw5m1cVLupB5xSarbj4LfBaQGjypAE82a83OC-sXjCRhdRrSzBYacAruf_SUul5tYCbBJFd0jgHsNaJlMi28m3ErOMYVibFzujqGDSdl7RgnwOHKKkYupZRxEqozm3mTuCdYTe57kWi8Khyl2nh">
        <span class="font-label-md text-label-md text-on-surface-variant hidden sm:inline">BUKUKU</span>
        <span class="font-label-md text-label-md text-outline-variant hidden sm:inline">/</span>
        <span class="font-label-md text-label-md font-semibold text-on-surface">Panel Administrasi</span>
    </div>

    {{-- Indikator Status Sistem & Avatar --}}
    <div class="flex items-center gap-space-md">
        {{-- Badge Status Sistem --}}
        <div class="hidden md:flex items-center gap-space-xs px-space-sm py-space-xs rounded-full bg-surface-container border border-surface-container-highest text-on-surface-variant font-label-sm text-label-sm">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            <span>Sistem Aktif - COD Aktif</span>
        </div>

        {{-- Avatar Admin --}}
        <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
        </div>
    </div>
</header>
