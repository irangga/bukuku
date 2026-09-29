{{--
|--------------------------------------------------------------------------
| Halaman Pesanan Diterima / Order Received
|--------------------------------------------------------------------------
| Halaman konfirmasi setelah pesanan berhasil dibuat. Menampilkan
| detail pesanan, instruksi COD, informasi pengiriman, dan daftar
| buku yang dipesan beserta rincian harga.
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'Pesanan Berhasil — BUKUKU')

@section('content')
{{-- Header Sukses dengan Stepper --}}
<div class="w-full bg-surface-container-low py-space-xl">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Stepper Progress Bar --}}
        <nav aria-label="Alur Pembelian" class="mb-space-xl">
            <div class="flex items-center justify-center max-w-xl mx-auto">
                <div class="flex items-center gap-space-xs text-on-surface-variant">
                    <span class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center font-label-sm text-label-sm text-on-surface">1</span>
                    <span class="font-label-md text-label-md">Keranjang</span>
                </div>
                <div class="flex-1 h-0.5 mx-space-sm bg-surface-container-highest"></div>
                <div class="flex items-center gap-space-xs text-on-surface-variant">
                    <span class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center font-label-sm text-label-sm text-on-surface">2</span>
                    <span class="font-label-md text-label-md">Pengiriman &amp; Pembayaran</span>
                </div>
                <div class="flex-1 h-0.5 mx-space-sm bg-primary"></div>
                <div class="flex items-center gap-space-xs text-primary font-semibold">
                    <span class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm">3</span>
                    <span class="font-label-md text-label-md text-on-surface">Selesai</span>
                </div>
            </div>
        </nav>

        {{-- Kotak Sukses --}}
        <div class="bg-surface-container-lowest p-space-xl shadow-sm rounded-lg flex flex-col items-center text-center">
            <div class="w-14 h-14 bg-surface-container-high rounded-full flex items-center justify-center mb-space-md">
                <span class="material-symbols-outlined text-primary text-headline-lg font-bold">check_circle</span>
            </div>
            <p class="font-label-md text-label-md uppercase tracking-wider text-secondary font-semibold mb-space-xs">Konfirmasi Berhasil</p>
            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-space-xs">Pesanan Berhasil Dibuat!</h1>
            <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">
                Terima kasih atas pesanan Anda. Kami sedang memproses buku pesanan Anda dan segera mengirimkannya ke alamat tujuan.
            </p>

            {{-- Informasi Ringkas --}}
            <div class="mt-space-lg w-full max-w-4xl grid grid-cols-2 md:grid-cols-4 gap-space-sm bg-surface-container-low p-space-md rounded-lg text-left">
                <div class="p-space-sm">
                    <span class="font-label-sm text-label-sm text-on-surface-variant block uppercase">Nomor Pesanan</span>
                    <span class="font-headline-sm text-headline-sm text-on-surface tracking-tight font-semibold">{{ $order->order_number }}</span>
                </div>
                <div class="p-space-sm">
                    <span class="font-label-sm text-label-sm text-on-surface-variant block uppercase">Tanggal Transaksi</span>
                    <span class="font-label-lg text-label-lg text-on-surface font-semibold">{{ $order->created_at->translatedFormat('d M Y') }}</span>
                </div>
                <div class="p-space-sm">
                    <span class="font-label-sm text-label-sm text-on-surface-variant block uppercase">Metode Pembayaran</span>
                    <span class="font-label-lg text-label-lg text-on-surface font-semibold flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-body-md">{{ $order->payment_method == 'cod' ? 'local_shipping' : 'account_balance' }}</span>
                        {{ strtoupper($order->payment_method) }}
                    </span>
                </div>
                <div class="p-space-sm">
                    <span class="font-label-sm text-label-sm text-on-surface-variant block uppercase">Total Tagihan</span>
                    <span class="font-headline-sm text-headline-sm text-secondary font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail Utama --}}
<div class="w-full bg-surface-container-lowest py-space-xl">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">

            {{-- Kolom Kiri: Instruksi COD & Alamat --}}
            <div class="lg:col-span-7 flex flex-col gap-space-lg">

                {{-- Kartu Instruksi --}}
                <div class="bg-surface-container-low p-space-lg rounded-lg shadow-sm">
                    <div class="flex items-center gap-space-sm mb-space-md">
                        <div class="w-8 h-8 rounded bg-primary text-on-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-body-lg">payments</span>
                        </div>
                        <div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">
                                {{ $order->payment_method == 'cod' ? 'Instruksi Pembayaran COD' : 'Instruksi Transfer Bank' }}
                            </h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">
                                {{ $order->payment_method == 'cod' ? 'Panduan serah terima uang tunai saat kurir tiba' : 'Panduan pembayaran pesanan via transfer' }}
                            </p>
                        </div>
                    </div>

                    {{-- Peringatan Penting --}}
                    <div class="bg-secondary-fixed/30 p-space-md rounded-lg mb-space-lg">
                        <div class="flex items-start gap-space-sm">
                            <span class="material-symbols-outlined text-secondary text-headline-sm shrink-0 mt-0.5">info</span>
                            <p class="font-body-sm text-body-sm text-on-surface leading-relaxed">
                                @if($order->payment_method == 'cod')
                                Harap siapkan uang pas sebesar <strong class="font-semibold text-on-surface">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> saat kurir mengantarkan paket ke rumah Anda. Anda dapat memeriksa segel paket sebelum melakukan pembayaran tunai kepada kurir.
                                @else
                                Silakan transfer sebesar <strong class="font-semibold text-on-surface">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> ke rekening BCA 1234567890 a.n. BUKUKU Indonesia. Pesanan Anda akan diproses setelah pembayaran terverifikasi.
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Tahapan Eksekusi --}}
                    <div class="space-y-space-md">
                        <span class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant block font-semibold">Tahapan Eksekusi Pesanan</span>
                        {{-- Step 1: Selesai --}}
                        <div class="flex items-start gap-space-md">
                            <div class="w-7 h-7 rounded-full bg-primary text-on-primary flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
                                <span class="material-symbols-outlined text-body-sm">check</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="font-label-lg text-label-lg text-on-surface font-semibold">1. Verifikasi Pesanan</p>
                                    <span class="font-label-sm text-label-sm bg-surface-container-high px-space-xs py-0.5 rounded text-on-surface font-medium">Selesai</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Data alamat dan ketersediaan stok buku telah tervalidasi otomatis oleh sistem.</p>
                            </div>
                        </div>
                        {{-- Step 2: Berjalan --}}
                        <div class="flex items-start gap-space-md">
                            <div class="w-7 h-7 rounded-full bg-secondary text-on-secondary flex items-center justify-center shrink-0 mt-0.5">
                                <span class="material-symbols-outlined text-body-sm">hourglass_top</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <p class="font-label-lg text-label-lg text-on-surface font-semibold">2. Pengemasan Aman Berlapis</p>
                                    <span class="font-label-sm text-label-sm bg-secondary text-on-secondary px-space-xs py-0.5 rounded font-medium">Sedang Berjalan</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Buku dilapisi plastik wrap pelindung dan kardus tebal untuk mencegah benturan.</p>
                            </div>
                        </div>
                        {{-- Step 3 --}}
                        <div class="flex items-start gap-space-md">
                            <div class="w-7 h-7 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center shrink-0 mt-0.5">
                                <span class="font-label-sm text-label-sm">3</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-lg text-label-lg text-on-surface font-semibold">3. Diserahkan ke Kurir Logistik</p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Paket diserahkan ke mitra ekspedisi dan nomor resi otomatis aktif.</p>
                            </div>
                        </div>
                        {{-- Step 4 --}}
                        <div class="flex items-start gap-space-md">
                            <div class="w-7 h-7 rounded-full bg-surface-container-high text-on-surface-variant flex items-center justify-center shrink-0 mt-0.5">
                                <span class="font-label-sm text-label-sm">4</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-label-lg text-label-lg text-on-surface font-semibold">
                                    {{ $order->payment_method == 'cod' ? '4. Pengiriman & Pembayaran COD di Tempat' : '4. Pengiriman Pesanan' }}
                                </p>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">
                                    {{ $order->payment_method == 'cod' ? 'Kurir mengantar pesanan langsung ke pintu rumah dan menerima pembayaran tunai.' : 'Kurir mengantar pesanan langsung ke pintu rumah Anda.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu Alamat Penerima --}}
                <div class="bg-surface-container-low p-space-lg rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-space-md">
                        <div class="flex items-center gap-space-sm">
                            <span class="material-symbols-outlined text-primary text-headline-sm">pin_drop</span>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Alamat &amp; Penerima</h2>
                        </div>
                        <span class="font-label-sm text-label-sm bg-surface-container-high px-space-sm py-1 rounded text-on-surface">
                            {{ $order->payment_method == 'cod' ? 'Reguler COD' : 'Reguler (Lunas)' }}
                        </span>
                    </div>
                    <div class="bg-surface-container-lowest p-space-md rounded-lg space-y-space-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-xs">
                            <span class="font-headline-sm text-headline-sm text-on-surface font-semibold">{{ $order->shipping_name }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant font-mono">{{ $order->shipping_phone }}</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant font-mono">-</p>
                        <div class="pt-space-xs">
                            <p class="font-body-md text-body-md text-on-surface leading-relaxed">
                                {{ $order->shipping_address }}
                            </p>
                        </div>
                        @if($order->notes)
                        <div class="mt-space-sm p-space-sm bg-surface-container-low rounded flex items-start gap-space-xs text-on-surface-variant">
                            <span class="material-symbols-outlined text-body-sm shrink-0 mt-0.5">edit_note</span>
                            <p class="font-body-sm text-body-sm">
                                <strong class="font-semibold text-on-surface">Catatan untuk Kurir:</strong> "{{ $order->notes }}"
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Buku & Harga --}}
            <div class="lg:col-span-5 flex flex-col gap-space-lg">
                <div class="bg-surface-container-low p-space-lg rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-space-md">
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Daftar Buku Pesanan</h2>
                        <span class="font-label-sm text-label-sm bg-primary text-on-primary px-space-xs py-0.5 rounded font-medium">{{ $order->items->count() }} Barang</span>
                    </div>
                    <div class="space-y-space-md">
                        @foreach($order->items as $item)
                        {{-- Buku --}}
                        <div class="flex gap-space-md p-space-sm bg-surface-container-lowest rounded-lg">
                            <div class="w-16 h-22 bg-surface-container-highest shrink-0 overflow-hidden rounded">
                                <img class="w-full h-full object-cover" alt="{{ $item->book->title }}" src="{{ $item->book->cover_image }}">
                            </div>
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="font-label-lg text-label-lg text-on-surface font-semibold line-clamp-1">{{ $item->book->title }}</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $item->book->author }}</p>
                                    <span class="font-label-sm text-label-sm text-on-surface-variant block mt-1">Buku Fisik</span>
                                </div>
                                <div class="flex items-center justify-between mt-space-xs">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                    <span class="font-label-lg text-label-lg text-on-surface font-semibold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Rincian Harga --}}
                    <div class="mt-space-lg pt-space-md bg-surface-container-lowest p-space-md rounded-lg space-y-space-xs">
                        <div class="flex justify-between font-body-sm text-body-sm text-on-surface-variant">
                            <span>Subtotal Buku ({{ $order->items->count() }} barang)</span>
                            <span class="text-on-surface">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-body-sm text-body-sm text-on-surface-variant">
                            <span>Biaya Pengiriman (Reguler)</span>
                            <span class="text-on-surface">Rp 0</span>
                        </div>
                        @if($order->payment_method == 'cod')
                        <div class="flex justify-between font-body-sm text-body-sm text-on-surface-variant">
                            <span>Biaya Penanganan COD</span>
                            <span class="text-on-surface font-medium">Rp 0 (Gratis)</span>
                        </div>
                        @endif
                        <div class="my-space-sm h-px bg-surface-container-highest"></div>
                        <div class="flex justify-between items-baseline pt-space-xs">
                            <div>
                                <span class="font-headline-sm text-headline-sm text-on-surface font-semibold block">
                                    {{ $order->payment_method == 'cod' ? 'Total Akhir COD' : 'Total Akhir' }}
                                </span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant">
                                    {{ $order->payment_method == 'cod' ? 'Bayar saat kurir menyerahkan barang' : 'Harap segera lakukan pembayaran' }}
                                </span>
                            </div>
                            <span class="font-headline-md text-headline-md text-on-surface font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="mt-space-lg flex flex-col gap-space-sm">
                        <a href="{{ url('/') }}" class="w-full bg-primary text-on-primary py-space-sm px-space-md rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center gap-space-xs hover:bg-primary/90 transition-opacity">
                            <span class="material-symbols-outlined text-body-md">storefront</span>
                            <span>Kembali ke Katalog Belanja</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Bilah Jaminan --}}
<div class="w-full bg-surface-container-low py-space-lg">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-space-md">
            <div class="flex items-center gap-space-md p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined">verified</span>
                </div>
                <div>
                    <h4 class="font-label-lg text-label-lg font-semibold text-on-surface">100% Buku Asli Penerbit</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Langsung dari penerbit resmi Indonesia tanpa bajakan.</p>
                </div>
            </div>
            <div class="flex items-center gap-space-md p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined">assignment_return</span>
                </div>
                <div>
                    <h4 class="font-label-lg text-label-lg font-semibold text-on-surface">Garansi Retur 7 Hari</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant">Tukar buku baru bila ada halaman cacat atau salah kirim.</p>
                </div>
            </div>
            <div class="flex items-center gap-space-md p-space-md bg-surface-container-lowest rounded-lg shadow-sm">
                <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-primary shrink-0">
                    <span class="material-symbols-outlined">support_agent</span>
                </div>
                <div>
                    <h4 class="font-label-lg text-label-lg font-semibold text-on-surface">Bantuan WhatsApp BUKUKU</h4>
                    <p class="font-body-sm text-body-sm text-on-surface-variant font-mono">0812-9988-7766 (Setiap hari: 08.00 - 21.00)</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
