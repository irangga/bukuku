{{--
|--------------------------------------------------------------------------
| Layout Halaman Tamu / Otentikasi (Guest Layout)
|--------------------------------------------------------------------------
| Layout minimalis tanpa header dan footer untuk halaman autentikasi
| seperti Login dan Registrasi. Fokus pada konten formulir saja.
|--------------------------------------------------------------------------
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BUKUKU — Masuk atau Daftar')</title>

    {{-- Google Fonts: Inter & Material Symbols --}}
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

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
<body class="bg-surface-container-lowest font-body-md text-on-surface antialiased min-h-screen">

    <main class="w-full bg-surface-container-lowest min-h-screen">
        <div class="flex flex-col w-full">
            @yield('content')
        </div>
    </main>

    @stack('scripts')
</body>
</html>
