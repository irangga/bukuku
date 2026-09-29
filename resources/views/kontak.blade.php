{{--
|--------------------------------------------------------------------------
| Halaman Kontak Kami
|--------------------------------------------------------------------------
| Halaman informasi kontak, FAQ pengiriman COD, dan form pesan masuk.
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'Kontak & Bantuan — BUKUKU')

@section('content')
<section class="w-full bg-surface-container-lowest py-space-xl">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl">
            
            {{-- Kolom Kiri: Info Kontak & Bantuan --}}
            <div class="lg:col-span-5 flex flex-col gap-space-lg">
                <div>
                    <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight font-normal mb-space-sm">
                        Halo, Ada yang Bisa Kami Bantu?
                    </h1>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Tim dukungan BUKUKU siap membantu Anda terkait informasi pesanan, pelacakan pengiriman COD, hingga konsultasi ketersediaan judul buku.
                    </p>
                </div>

                {{-- Contact Methods Cards --}}
                <div class="flex flex-col gap-space-md">
                    <div class="bg-surface-container p-space-lg rounded-xl flex items-start gap-space-md">
                        <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-primary">support_agent</span>
                        </div>
                        <div>
                            <h3 class="font-label-lg text-label-lg font-semibold text-on-surface">Layanan Pelanggan WhatsApp</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 mb-space-xs">Respon cepat untuk pelacakan dan komplain pesanan.</p>
                            <p class="font-label-md text-label-md font-mono text-on-surface">+62 812-9988-7766</p>
                            <p class="font-label-sm text-label-sm text-on-surface-variant mt-1">Setiap Hari, 08:00 - 21:00 WIB</p>
                        </div>
                    </div>

                    <div class="bg-surface-container-low p-space-lg rounded-xl flex items-start gap-space-md">
                        <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-on-surface-variant">mail</span>
                        </div>
                        <div>
                            <h3 class="font-label-lg text-label-lg font-semibold text-on-surface">Email Kemitraan & Penerbit</h3>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5 mb-space-xs">Untuk kerjasama distribusi dan pengadaan buku.</p>
                            <p class="font-label-md text-label-md font-mono text-on-surface">halo@bukuku.id</p>
                        </div>
                    </div>
                </div>

                {{-- FAQ Singkat COD --}}
                <div class="mt-space-sm">
                    <h3 class="font-headline-sm text-headline-sm font-semibold text-on-surface mb-space-md">Pertanyaan Umum Pengiriman COD</h3>
                    
                    <div class="space-y-space-md">
                        <div class="border-l-2 border-primary pl-space-md">
                            <h4 class="font-label-lg text-label-lg font-semibold text-on-surface mb-1">Apakah boleh membuka paket sebelum membayar?</h4>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Sesuai standar operasional, Anda diizinkan untuk memeriksa segel kemasan luar. Namun, kemasan plastik (shrink wrap) pelindung buku tidak boleh dirusak sebelum pembayaran diselesaikan ke kurir.</p>
                        </div>
                        
                        <div class="border-l-2 border-primary pl-space-md">
                            <h4 class="font-label-lg text-label-lg font-semibold text-on-surface mb-1">Bagaimana jika buku yang diterima cacat cetak?</h4>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Kami memberikan garansi 100%. Silakan bayar terlebih dahulu ke kurir, lalu hubungi WhatsApp Layanan Pelanggan kami. Buku pengganti akan kami kirimkan tanpa biaya tambahan.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Formulir Pesan --}}
            <div class="lg:col-span-7">
                <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-space-xl shadow-sm">
                    <div class="mb-space-lg">
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Kirim Pesan Melalui Formulir</h2>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kami akan membalas pesan Anda melalui email maksimal dalam 1x24 jam.</p>
                    </div>

                    @if(session('success'))
                    <div class="mb-space-md p-space-md bg-green-100 text-green-800 rounded-lg flex items-start gap-space-sm border border-green-200">
                        <span class="material-symbols-outlined shrink-0 mt-0.5 text-green-600">check_circle</span>
                        <div class="flex-1">
                            <p class="font-label-md text-label-md font-semibold">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                    </div>
                    @endif

                    <form class="space-y-space-md" method="POST" action="{{ url('/kontak/kirim') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="contact-name">Nama Lengkap</label>
                                <input class="w-full h-10 px-3.5 bg-surface-container-low border border-transparent focus:border-primary text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline" id="contact-name" name="name" placeholder="Masukkan nama Anda" required type="text">
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="contact-email">Alamat Email</label>
                                <input class="w-full h-10 px-3.5 bg-surface-container-low border border-transparent focus:border-primary text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline" id="contact-email" name="email" placeholder="nama@email.com" required type="email">
                            </div>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="contact-subject">Subjek Pesan</label>
                            <select class="w-full h-10 px-3.5 bg-surface-container-low border border-transparent focus:border-primary text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all appearance-none cursor-pointer" id="contact-subject" name="subject" required>
                                <option value="" disabled selected>Pilih topik pertanyaan...</option>
                                <option value="Pertanyaan Seputar Pemesanan & COD">Pertanyaan Seputar Pemesanan & COD</option>
                                <option value="Komplain Buku Rusak / Cacat Cetak">Komplain Buku Rusak / Cacat Cetak</option>
                                <option value="Permintaan Restock Judul Buku">Permintaan Restock Judul Buku</option>
                                <option value="Penawaran Kerjasama Penerbit">Penawaran Kerjasama Penerbit</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="contact-message">Isi Pesan / Pertanyaan</label>
                            <textarea class="w-full px-3.5 py-3 bg-surface-container-low border border-transparent focus:border-primary text-on-surface font-body-sm text-body-sm rounded-lg outline-none transition-all placeholder:text-outline resize-none" id="contact-message" name="message" placeholder="Jelaskan pertanyaan atau masalah Anda secara detail..." required rows="5"></textarea>
                        </div>

                        <div class="pt-space-sm">
                            <button class="w-full py-3 bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold hover:opacity-90 active:opacity-95 transition-opacity shadow-sm flex items-center justify-center gap-space-xs" type="submit">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                                Kirim Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
