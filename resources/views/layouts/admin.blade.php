{{--
|--------------------------------------------------------------------------
| Layout Panel Administrasi (Admin Layout)
|--------------------------------------------------------------------------
| Layout induk untuk seluruh halaman panel admin BUKUKU. Menyertakan
| sidebar navigasi tetap di sisi kiri dan top header bar dengan
| indikator status sistem.
|--------------------------------------------------------------------------
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin — BUKUKU Panel Administrasi')</title>

    {{-- Google Fonts: Inter & Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
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
<body class="bg-surface-container-lowest font-body-sm text-body-sm text-on-surface antialiased" x-data="{ sidebarOpen: false }">

    {{-- Komponen Sidebar Navigasi Admin --}}
    @include('components.admin-sidebar')

    {{-- Area Konten Utama (offset sidebar 16rem / w-64 pada desktop) --}}
    <div class="lg:pl-64 flex flex-col min-h-screen">

        {{-- Komponen Top Bar Admin --}}
        @include('components.admin-topbar')

        {{-- Konten Utama Halaman Admin --}}
        <main class="relative mt-16 w-full bg-surface-container-lowest min-h-[calc(100vh-4rem)] px-space-md py-space-md lg:px-space-lg lg:py-space-lg">
            <div class="flex flex-col w-full">
                @yield('content')
            </div>
        </main>
    </div>

    @stack('scripts')
</body>
</html>
