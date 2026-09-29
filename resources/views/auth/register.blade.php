{{--
|--------------------------------------------------------------------------
| Halaman Pendaftaran / Register
|--------------------------------------------------------------------------
| Halaman pembuatan akun baru untuk calon pelanggan BUKUKU.
| Menggunakan layout guest. Menyediakan formulir registrasi lengkap
| dengan validasi konfirmasi kata sandi di sisi klien.
|--------------------------------------------------------------------------
--}}
@extends('layouts.guest')

@section('title', 'Daftar Akun Baru — BUKUKU')

@section('content')
<div class="flex flex-col w-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg">

        {{-- Identitas Brand --}}
        <div class="flex items-center justify-center gap-2 mb-8">
            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-on-primary font-headline-sm text-headline-sm font-bold tracking-tighter">B</div>
            <span class="font-headline-md text-headline-md tracking-tight text-on-surface uppercase">Bukuku</span>
        </div>

        {{-- Kartu Formulir Pendaftaran --}}
        <div class="w-full bg-surface-container-lowest rounded-lg p-8 shadow-sm" style="box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);">

            {{-- Header Formulir --}}
            <div class="mb-8">
                <h1 class="font-headline-md text-headline-md text-on-surface">Daftar Akun Baru</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-2">Buat akun untuk kemudahan pemesanan buku dan pelacakan pengiriman.</p>
            </div>

            {{-- Formulir Registrasi --}}
            <form class="space-y-5" id="registration-form" method="POST" action="{{ url('/register') }}">
                @csrf

                @if ($errors->any())
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-600 font-medium">Mohon periksa kembali data Anda:</p>
                        <ul class="list-disc pl-5 text-xs text-red-600 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Nama Lengkap --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="full-name">Nama Lengkap <span class="text-secondary">*</span></label>
                    <div class="relative">
                        <input class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline focus:bg-surface-container-lowest" id="full-name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap sesuai identitas" required type="text">
                    </div>
                </div>

                {{-- Alamat Email --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="email">Alamat Email <span class="text-secondary">*</span></label>
                    <div class="relative">
                        <input class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline focus:bg-surface-container-lowest" id="email" name="email" value="{{ old('email') }}" placeholder="contoh@domain.id" required type="email">
                    </div>
                </div>

                {{-- Kata Sandi --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="password">Kata Sandi <span class="text-secondary">*</span></label>
                    <div class="relative flex items-center">
                        <input class="w-full h-10 pl-3.5 pr-10 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline focus:bg-surface-container-lowest" id="password" minlength="8" name="password" placeholder="Minimal 8 karakter" required type="password">
                        <button aria-label="Tampilkan atau sembunyikan kata sandi" class="absolute right-2.5 p-1 text-on-surface-variant hover:text-on-surface focus:outline-none flex items-center justify-center" id="toggle-password" type="button" onclick="togglePasswordVisibility('password', 'eye-icon-1')">
                            <span class="material-symbols-outlined text-body-lg" id="eye-icon-1">visibility</span>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Kata Sandi --}}
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="password-confirm">Konfirmasi Kata Sandi <span class="text-secondary">*</span></label>
                    <div class="relative flex items-center">
                        <input class="w-full h-10 pl-3.5 pr-10 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline focus:bg-surface-container-lowest" id="password-confirm" minlength="8" name="password_confirmation" placeholder="Ulangi kata sandi" required type="password">
                        <button aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi" class="absolute right-2.5 p-1 text-on-surface-variant hover:text-on-surface focus:outline-none flex items-center justify-center" id="toggle-password-confirm" type="button" onclick="togglePasswordVisibility('password-confirm', 'eye-icon-2')">
                            <span class="material-symbols-outlined text-body-lg" id="eye-icon-2">visibility</span>
                        </button>
                    </div>
                    <p class="hidden font-label-sm text-label-sm text-secondary mt-1.5" id="password-match-error">Kata sandi dan konfirmasi tidak sesuai.</p>
                </div>

                {{-- Tombol Submit --}}
                <div class="pt-2">
                    <button class="w-full py-3 bg-primary text-on-primary rounded-lg font-label-lg text-label-lg transition-opacity hover:opacity-90 active:opacity-95 shadow-sm" type="submit">Buat Akun Sekarang</button>
                </div>
            </form>

            {{-- Pemisah --}}
            <div class="my-6 flex items-center">
                <div class="flex-grow h-px bg-surface-container-high"></div>
                <span class="px-3 font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider">atau</span>
                <div class="flex-grow h-px bg-surface-container-high"></div>
            </div>

            {{-- Tautan Login --}}
            <div class="text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Sudah memiliki akun?
                    <a class="font-label-lg text-label-lg text-on-surface underline ml-1 hover:opacity-80" href="{{ url('/login') }}">Masuk di sini</a>
                </p>
            </div>
        </div>

        {{-- Badge Keamanan --}}
        <div class="mt-6 flex items-center justify-center gap-6 text-on-surface-variant font-label-sm text-label-sm">
            <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-base">lock</span> Enkripsi Aman 256-Bit
            </span>
            <span class="flex items-center gap-1.5">
                <span class="material-symbols-outlined text-base">verified</span> Toko Resmi Bukuku
            </span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi toggle visibilitas kata sandi
    function togglePasswordVisibility(fieldId, iconId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    }
</script>
@endpush
