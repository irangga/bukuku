{{--
|--------------------------------------------------------------------------
| Halaman Masuk / Login
|--------------------------------------------------------------------------
| Halaman autentikasi untuk pengguna yang sudah terdaftar.
| Menggunakan layout guest (tanpa header/footer).
| Menyediakan formulir email, kata sandi, dan akun demo pengujian.
|--------------------------------------------------------------------------
--}}
@extends('layouts.guest')

@section('title', 'Masuk — BUKUKU')

@section('content')
<div class="w-full flex items-center justify-center min-h-[calc(100vh-80px)] py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md bg-white border border-[#E0E0E0] rounded-lg p-8 shadow-sm">

        {{-- Formulir Login Utama --}}
        <form class="space-y-5" method="POST" action="{{ url('/login') }}">
            @csrf

            {{-- Menampilkan Error Validasi Global --}}
            @if ($errors->any())
                <div class="p-3 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-600 font-medium">Mohon periksa kembali form Anda:</p>
                    <ul class="list-disc pl-5 text-xs text-red-600 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Field Alamat Email --}}
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-black mb-1.5" for="email">ALAMAT EMAIL</label>
                <div class="relative">
                    <input class="w-full border border-[#CCCCCC] rounded-lg p-3 font-body-sm text-body-sm text-black placeholder:text-[#7e7576] outline-none transition-colors duration-150 focus:border-black focus:ring-1 focus:ring-black" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required type="email" autofocus>
                </div>
            </div>

            {{-- Field Kata Sandi --}}
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-black" for="password">KATA SANDI</label>
                    <a class="font-label-sm text-label-sm text-black hover:underline focus:outline-none focus:underline font-medium" href="#">Lupa kata sandi?</a>
                </div>
                <div class="relative flex items-center">
                    <input class="w-full border border-[#CCCCCC] rounded-lg p-3 pr-10 font-body-sm text-body-sm text-black placeholder:text-[#7e7576] outline-none transition-colors duration-150 focus:border-black focus:ring-1 focus:ring-black" id="password" name="password" placeholder="••••••••" required type="password">
                    <button aria-label="Tampilkan atau sembunyikan kata sandi" class="absolute right-3 p-1 text-[#7e7576] hover:text-black focus:outline-none transition-colors" id="togglePassword" type="button">
                        <span class="material-symbols-outlined text-[20px] select-none" id="toggleIcon">visibility_off</span>
                    </button>
                </div>
            </div>

            {{-- Checkbox Ingat Saya --}}
            <div class="flex items-center pt-1">
                <label class="relative flex items-center cursor-pointer select-none">
                    <input class="peer sr-only" id="remember" name="remember" type="checkbox">
                    <div class="w-4 h-4 bg-white border border-black rounded-[2px] peer-checked:bg-black peer-focus-visible:ring-2 peer-focus-visible:ring-black flex items-center justify-center transition-colors">
                        <span class="material-symbols-outlined text-white text-[14px] opacity-0 peer-checked:opacity-100 font-bold leading-none pointer-events-none">check</span>
                    </div>
                    <span class="ml-2.5 font-body-sm text-body-sm text-[#1b1c1c]">Ingat saya di perangkat ini</span>
                </label>
            </div>

            {{-- Tombol Aksi Utama --}}
            <div class="pt-2">
                <button class="w-full bg-black text-white py-3 rounded-lg font-label-lg text-label-lg font-medium tracking-normal transition-opacity duration-150 hover:opacity-90 active:opacity-95 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2" type="submit">
                    Masuk Sekarang
                </button>
            </div>

            {{-- Panel Akun Demo Pengujian --}}
            <div class="mt-5 pt-4 border-t border-gray-100">
                <div class="bg-neutral-50 border border-neutral-200 rounded-lg p-3">
                    <div class="flex items-center gap-1.5 mb-2.5">
                        <span class="material-symbols-outlined text-[16px] text-neutral-600">science</span>
                        <span class="text-[11px] font-bold tracking-wider text-neutral-600 uppercase">Akun Demo (Sandi: password):</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2.5">
                        <button type="button" onclick="document.getElementById('email').value='admin@bukuku.test'; document.getElementById('password').value='password';" class="bg-blue-50 border border-blue-200 rounded-lg p-2.5 flex flex-col gap-1 transition-colors hover:bg-blue-100 cursor-pointer text-left w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px] text-blue-700">shield_person</span>
                                <span class="text-xs font-bold text-blue-900">Admin</span>
                            </div>
                            <span class="text-[11px] font-mono text-blue-800 break-all leading-tight">admin@bukuku.test</span>
                        </button>
                        <button type="button" onclick="document.getElementById('email').value='danang@bukuku.test'; document.getElementById('password').value='password';" class="bg-emerald-50 border border-emerald-200 rounded-lg p-2.5 flex flex-col gap-1 transition-colors hover:bg-emerald-100 cursor-pointer text-left w-full focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px] text-emerald-700">person</span>
                                <span class="text-xs font-bold text-emerald-900">Customer</span>
                            </div>
                            <span class="text-[11px] font-mono text-emerald-800 break-all leading-tight">danang@bukuku.test</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- Garis Pemisah --}}
        <div class="relative my-8">
            <div class="w-full h-px bg-[#E0E0E0]"></div>
        </div>

        {{-- Tautan Pendaftaran Bawah --}}
        <div class="text-center">
            <p class="text-sm text-[#4c4546]">Belum memiliki akun?
                <a class="font-semibold text-black hover:underline focus:outline-none focus:underline ml-1" href="{{ url('/register') }}">Daftar Akun Baru</a>
            </p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Logika toggle visibilitas kata sandi
    (function() {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function() {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                toggleIcon.textContent = isPassword ? 'visibility' : 'visibility_off';
            });
        }
    })();
</script>
@endpush
