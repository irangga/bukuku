{{--
|--------------------------------------------------------------------------
| Layout Utama Pengguna (User Layout)
|--------------------------------------------------------------------------
| Layout induk untuk seluruh halaman publik yang diakses oleh pengunjung
| dan pelanggan toko buku BUKUKU. Menyertakan header navigasi, footer,
| serta konfigurasi Tailwind CSS dengan design token kustom.
|--------------------------------------------------------------------------
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BUKUKU — Toko Buku Daring Minimalis Indonesia')</title>
    <meta name="description" content="@yield('meta_description', 'BUKUKU adalah toko buku daring minimalis Indonesia dengan opsi Bayar di Tempat (COD) ke seluruh Nusantara.')">

    {{-- Google Fonts: Inter & Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN & AlpineJS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Konfigurasi Design Token Tailwind Kustom BUKUKU --}}
    @include('components.tailwind-config')

    {{-- Style dasar reset --}}
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>

    @stack('styles')
</head>
<body class="bg-surface-container-lowest font-body-md text-on-surface antialiased">

    {{-- Komponen Header Navigasi Pengguna --}}
    @include('components.user-header')

    {{-- Konten Utama Halaman --}}
    <main class="w-full pt-16 bg-surface-container-lowest min-h-screen">
        <div class="flex flex-col w-full">
            @yield('content')
        </div>
    </main>

    {{-- Komponen Footer --}}
    @include('components.user-footer')

    @stack('scripts')
</body>
</html>
