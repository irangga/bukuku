{{--
|--------------------------------------------------------------------------
| Halaman Tentang Kami
|--------------------------------------------------------------------------
| Halaman informasi perusahaan, misi, dan nilai-nilai BUKUKU.
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'Tentang Kami — BUKUKU')

@section('content')
<section class="w-full bg-surface-container-lowest py-space-xl">
    <div class="max-w-4xl mx-auto px-6">
        {{-- Meta Label & Overline --}}
        <div class="flex items-center gap-space-xs text-on-surface-variant font-label-sm text-label-sm uppercase tracking-widest mb-space-sm">
            <span class="inline-block w-2 h-2 rounded-full bg-primary"></span>
            <span>Tentang BUKUKU</span>
            <span class="text-outline-variant">/</span>
            <span>Manifesto & Komitmen</span>
        </div>

        {{-- Headline --}}
        <h1 class="font-headline-lg text-headline-lg text-primary tracking-tight font-normal mb-space-lg leading-tight">
            Menghadirkan Pustaka Berkualitas dengan Kemudahan Belanja di Seluruh Nusantara
        </h1>

        {{-- Editorial Intro Lead --}}
        <div class="space-y-space-md mb-space-xl">
            <p class="font-body-lg text-body-lg text-on-surface leading-relaxed font-normal">
                BUKUKU lahir dari dedikasi murni terhadap aroma kertas cetak dan kedalaman gagasan. Kami meyakini bahwa akses terhadap bacaan bermutu bukan sekadar transaksi niaga, melainkan jembatan yang menghubungkan daya kritis masyarakat dari sabang sampai merauke.
            </p>
            <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                Setiap jilid buku yang melangkah keluar dari rak penyimpanan kami dijamin <strong class="text-on-surface font-semibold">100% orisinil</strong>, berlisensi sah, dan diambil langsung dari penerbit resmi Indonesia. Kami menolak peredaran buku bajakan demi menjaga keluhuran hak cipta para cendekiawan dan penulis anak bangsa.
            </p>
        </div>

        {{-- Asymmetrical Editorial Imagery & Stat Accent --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-space-md items-center mb-space-xl">
            <div class="md:col-span-8 overflow-hidden rounded-xl bg-surface-container-low shadow-sm">
                <img alt="Interior Studio Kurasi Buku BUKUKU" class="w-full h-80 object-cover hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTgh9ydGZETZe0JtNafuzOdfMApW9Ye4lyebJMD8E4dknpgdqnkDHY0a7J-sb72HiAZoiW3sn4PGJVHe8f2ok7NbBHJPchtSj5pwYngkUSzUY2LoMZ5idbjEujcmPkyH4mFKtRMbakCt7WzlDWBW73Ox-SVLD-RSZycecrppPhyJ4oHYy7GQGe6RTgL9P41rYh5Xa95xrkI6uHuCSY98wVqKyHMom7CxgPJfN4mGoie-sV2JNnWnVKMg">
            </div>
            <div class="md:col-span-4 flex flex-col gap-space-md">
                <div class="p-space-lg bg-surface-container rounded-xl shadow-sm">
                    <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-space-xs">Cakupan Pengiriman</span>
                    <div class="font-headline-lg text-headline-lg font-semibold text-on-surface">514+</div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">Kota dan kabupaten di Indonesia terjangkau sistem Bayar di Tempat (COD).</p>
                </div>
                <div class="p-space-lg bg-surface-container rounded-xl shadow-sm">
                    <span class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider block mb-space-xs">Katalog Aktif</span>
                    <div class="font-headline-lg text-headline-lg font-semibold text-on-surface">12.400+</div>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-xs">Judul sastra, filsafat, humaniora, dan teknologi siap dikirim.</p>
                </div>
            </div>
        </div>

        {{-- Section: Misi Inklusi & Akses --}}
        <div class="bg-surface-container-low rounded-xl p-space-xl mb-space-xl shadow-sm">
            <div class="max-w-2xl">
                <span class="font-label-sm text-label-sm uppercase tracking-widest text-secondary font-semibold block mb-space-xs">Aksesibilitas Tanpa Sekat</span>
                <h2 class="font-headline-md text-headline-md text-on-surface mb-space-sm font-semibold">
                    Literasi Tanpa Hambatan Finansial Digital
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed mb-space-md">
                    Kendala perbankan digital dan keterbatasan kartu pembayaran tidak boleh menjadi penghalang seseorang menjangkau ilmu pengetahuan. Kami menghadirkan infrastruktur logistik <span class="text-on-surface font-medium">Cash on Delivery (COD)</span> yang menjangkau hingga pelosok desa, memastikan transaksi aman, langsung di tangan Anda sebelum uang berpindah.
                </p>
                <div class="flex flex-wrap items-center gap-space-sm text-on-surface font-label-md text-label-md">
                    <span class="inline-flex items-center gap-space-xs bg-surface-container-lowest px-space-sm py-space-xs rounded-lg shadow-sm">
                        <span class="material-symbols-outlined text-body-sm text-secondary">verified</span> Tanpa Minimum Belanja
                    </span>
                    <span class="inline-flex items-center gap-space-xs bg-surface-container-lowest px-space-sm py-space-xs rounded-lg shadow-sm">
                        <span class="material-symbols-outlined text-body-sm text-secondary">local_shipping</span> Mitra Kurir Nasional
                    </span>
                    <span class="inline-flex items-center gap-space-xs bg-surface-container-lowest px-space-sm py-space-xs rounded-lg shadow-sm">
                        <span class="material-symbols-outlined text-body-sm text-secondary">lock</span> Verifikasi Resi Instan
                    </span>
                </div>
            </div>
        </div>

        {{-- 3 Nilai Utama --}}
        <div class="mb-space-xl">
            <div class="mb-space-md">
                <span class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant font-semibold">Pilar Pelayanan</span>
                <h3 class="font-headline-md text-headline-md text-primary font-semibold">Prinsip Kerja BUKUKU</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
                {{-- Card 1 --}}
                <div class="bg-surface-container-low rounded-xl p-space-lg flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center mb-space-md shadow-sm">
                            <span class="material-symbols-outlined text-primary text-headline-sm">verified_user</span>
                        </div>
                        <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-xs">
                            Keaslian Mutlak
                        </h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                            Kemitraan langsung dan eksklusif dengan penerbit independen maupun pers universitas ternama di seluruh Indonesia. Garansi uang kembali 100% jika terbukti non-orisinal.
                        </p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center gap-space-xs text-on-surface font-label-sm text-label-sm">
                        <span class="font-semibold">01</span>
                        <span class="text-outline-variant">—</span>
                        <span class="text-on-surface-variant">Integritas Kurasi</span>
                    </div>
                </div>

                {{-- Card 2 --}}
                <div class="bg-surface-container-low rounded-xl p-space-lg flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center mb-space-md shadow-sm">
                            <span class="material-symbols-outlined text-primary text-headline-sm">payments</span>
                        </div>
                        <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-xs">
                            Akses Terbuka (COD)
                        </h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                            Belanja aman dan percaya diri tanpa kewajiban kartu kredit atau rekening bank digital. Periksa paket di depan pintu rumah Anda sebelum menyerahkan pembayaran tunai.
                        </p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center gap-space-xs text-on-surface font-label-sm text-label-sm">
                        <span class="font-semibold">02</span>
                        <span class="text-outline-variant">—</span>
                        <span class="text-on-surface-variant">Inklusi Logistik</span>
                    </div>
                </div>

                {{-- Card 3 --}}
                <div class="bg-surface-container-low rounded-xl p-space-lg flex flex-col justify-between shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="w-10 h-10 rounded-lg bg-surface-container-lowest flex items-center justify-center mb-space-md shadow-sm">
                            <span class="material-symbols-outlined text-primary text-headline-sm">inventory_2</span>
                        </div>
                        <h4 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-xs">
                            Pengemasan Aman
                        </h4>
                        <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                            Setiap eksemplar dibalut bantalan bubble wrap ekstra tebal dan kardus penguat kaku sudut ganda agar tepi buku tiba dalam kondisi sudut tajam tanpa cacat.
                        </p>
                    </div>
                    <div class="mt-space-lg pt-space-sm flex items-center gap-space-xs text-on-surface font-label-sm text-label-sm">
                        <span class="font-semibold">03</span>
                        <span class="text-outline-variant">—</span>
                        <span class="text-on-surface-variant">Preservasi Fisik</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Profil Kurasi Buku --}}
        <div class="bg-surface-container rounded-xl p-space-xl mb-space-xl shadow-sm">
            <div class="flex flex-col md:flex-row gap-space-lg items-start">
                <div class="md:w-1/3 shrink-0">
                    <span class="font-label-sm text-label-sm uppercase tracking-widest text-on-surface-variant font-semibold block mb-space-xs">Disiplin Koleksi</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface font-semibold leading-snug">
                        Kedalaman Kurasi untuk Pembaca Tekun
                    </h3>
                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-space-sm">
                        Kami membatasi rak kami dari buku instan tak berbobot. Setiap katalog disaring oleh dewan pembaca internal.
                    </p>
                </div>
                <div class="md:w-2/3 grid grid-cols-1 sm:grid-cols-2 gap-space-md w-full">
                    <div class="p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                        <div class="flex items-center gap-space-xs mb-space-xs">
                            <span class="material-symbols-outlined text-body-md text-primary">auto_stories</span>
                            <span class="font-label-lg text-label-lg font-semibold text-on-surface">Sastra & Humaniora</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Novel kanonik Nusantara, antologi puisi kontemporer, dan terjemahan sastra dunia terpilih.
                        </p>
                    </div>
                    <div class="p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                        <div class="flex items-center gap-space-xs mb-space-xs">
                            <span class="material-symbols-outlined text-body-md text-primary">psychology</span>
                            <span class="font-label-lg text-label-lg font-semibold text-on-surface">Filsafat & Pemikiran</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Eksplorasi ontologi, etika politik, epistemologi, serta risalah sosial kritis dari para filsuf klasik hingga modern.
                        </p>
                    </div>
                    <div class="p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                        <div class="flex items-center gap-space-xs mb-space-xs">
                            <span class="material-symbols-outlined text-body-md text-primary">terminal</span>
                            <span class="font-label-lg text-label-lg font-semibold text-on-surface">Teknologi & Sains</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Arsitektur perangkat lunak, sains komputasi, kecerdasan artifisial, dan telaah masa depan peradaban digital.
                        </p>
                    </div>
                    <div class="p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                        <div class="flex items-center gap-space-xs mb-space-xs">
                            <span class="material-symbols-outlined text-body-md text-primary">self_improvement</span>
                            <span class="font-label-lg text-label-lg font-semibold text-on-surface">Pengembangan Diri</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Buku panduan reflektif berbasis psikologi kognitif yang memicu pertumbuhan karakter dan ketangguhan mental.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Galeri & Studio Packaging Visual --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md mb-space-xl">
            <div class="overflow-hidden rounded-xl bg-surface-container-low shadow-sm">
                <img alt="Proses Pengemasan Buku BUKUKU" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDvPoTcG5fvO3Rp0Q916RvlTCHLDgsdmwJ8S-EtOjhfQy9UurmiTTxb6ttx8-nTwDcEsv5a3xpHxSAB43SpQzy0mlQAzSSqomR3fYd50OXwsyoIBZ6dlf4xHjIoclJK7Ys6eeNQYTAlGUQwnAboNa0rNfnk1NkQ3bWeBC0atDfn19ZlWhBTLq5VI_G6HGIsiSb8UyUawX_-1xTItwb13P6O3310fwgX2-U87Gc5PH1d8n1iBKHI_CdfJQ">
            </div>
            <div class="overflow-hidden rounded-xl bg-surface-container-low shadow-sm">
                <img alt="Koleksi Pustaka Pilihan" class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBZgcCz-PYOPlq7HpSF9qqeUtUr0Sl1u8mnjGacbqTrdwcu6sWVeg-97m9tFlmFUu2lm8CzqRzkof6cGdzPfDzdWAte4hSgidKaTDz7-H1p4CFR29MDA54-vN-OL82M4pfDkzisSbBT5_rFHyxp1gBdhucfzF8heIU6U0woWiL8d09tjFM6JVltcP__JWmk6YTqGK56-0MnXU0byCCeJg-xYzxr_QKPxnkD9j9mGBzC9Jgvc3WFw0RxDg">
            </div>
        </div>

        {{-- Catatan Penutup & Tanda Tangan Tim --}}
        <div class="bg-surface-container-lowest p-space-xl rounded-xl shadow-sm">
            <div class="max-w-2xl">
                <span class="material-symbols-outlined text-headline-lg text-primary mb-space-sm block">format_quote</span>
                <p class="font-body-lg text-body-lg text-on-surface leading-relaxed mb-space-lg italic">
                    "Membaca bukan pelarian dari kenyataan, melainkan upaya paling khusyuk untuk memahami dunia secara lebih jernih. Kami merasa terhormat menjadi kawan berlayar di rak bacaan Anda."
                </p>
                <div class="flex items-center justify-between flex-wrap gap-space-md">
                    <div>
                        <p class="font-headline-sm text-headline-sm font-semibold text-primary">Tim Kuratorial & Operasional</p>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">BUKUKU Pustaka Indonesia — Jakarta Selatan</p>
                    </div>
                    {{-- Stylized Minimal Monogram Stamp --}}
                    <div class="flex items-center gap-space-sm bg-surface-container px-space-md py-space-sm rounded-lg">
                        <span class="material-symbols-outlined text-primary">local_library</span>
                        <div class="text-left font-label-sm text-label-sm">
                            <span class="block font-semibold text-on-surface">BUKUKU INDONESIA</span>
                            <span class="block text-on-surface-variant">Est. 2024 • Arsip Resmi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Action CTA Footer Strip --}}
        <div class="mt-space-xl flex flex-col sm:flex-row items-center justify-between gap-space-md p-space-lg bg-primary text-on-primary rounded-xl shadow-md">
            <div>
                <h4 class="font-headline-sm text-headline-sm font-semibold">Siap Menemukan Bacaan Berikutnya?</h4>
                <p class="font-body-sm text-body-sm text-on-primary-container">Jelajahi rilisan terbaru dan gunakan opsi Bayar di Tempat (COD).</p>
            </div>
            <div class="flex items-center gap-space-sm shrink-0">
                <a class="px-space-lg py-space-sm bg-surface-container-lowest text-primary font-label-lg text-label-lg font-semibold rounded-lg hover:bg-surface-container-high transition-colors" href="{{ url('/katalog') }}">
                    Lihat Katalog
                </a>
                <a class="px-space-md py-space-sm bg-tertiary-container text-on-tertiary font-label-lg text-label-lg rounded-lg hover:bg-tertiary-container/80 transition-colors" href="{{ url('/kontak') }}">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
