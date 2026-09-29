{{--
|--------------------------------------------------------------------------
| Halaman Checkout / Pembayaran
|--------------------------------------------------------------------------
| Halaman proses pemesanan multi-langkah: keranjang, pengiriman,
| pembayaran COD. Menampilkan ringkasan pesanan dan formulir alamat.
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'Checkout Pembayaran — BUKUKU')

@section('content')
<div class="w-full bg-surface-container-low py-space-xl">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Stepper Progress Bar --}}
        <nav aria-label="Alur Pembelian" class="mb-space-xl">
            <div class="flex items-center justify-center max-w-xl mx-auto">
                <div class="flex items-center gap-space-xs text-primary font-semibold">
                    <span class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm">1</span>
                    <span class="font-label-md text-label-md text-on-surface">Keranjang</span>
                </div>
                <div class="flex-1 h-0.5 mx-space-sm bg-primary"></div>
                <div class="flex items-center gap-space-xs text-primary font-semibold">
                    <span class="w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm">2</span>
                    <span class="font-label-md text-label-md text-on-surface">Pengiriman &amp; Pembayaran</span>
                </div>
                <div class="flex-1 h-0.5 mx-space-sm bg-surface-container-highest"></div>
                <div class="flex items-center gap-space-xs text-on-surface-variant">
                    <span class="w-6 h-6 rounded-full bg-surface-container-high flex items-center justify-center font-label-sm text-label-sm text-on-surface">3</span>
                    <span class="font-label-md text-label-md">Selesai</span>
                </div>
            </div>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">

            {{-- Kolom Kiri: Formulir Pengiriman --}}
            <div class="lg:col-span-7 flex flex-col gap-space-lg">

                {{-- Kartu Informasi Pengiriman --}}
                <div class="bg-surface-container-lowest p-space-lg rounded-lg shadow-sm">
                    <div class="flex items-center gap-space-sm mb-space-lg">
                        <span class="material-symbols-outlined text-primary text-headline-sm">local_shipping</span>
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Informasi Pengiriman</h2>
                    </div>

                    <form class="space-y-space-md" id="shipping-form" method="POST" action="{{ url('/checkout/process') }}">
                        @csrf
                        {{-- Hidden book_id --}}
                        @if(isset($book))
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        @endif

                        {{-- Hidden cart items --}}
                        @if(isset($carts) && $carts->count() > 0)
                            @foreach($carts as $index => $cart)
                                <input type="hidden" name="items[{{ $index }}][cart_id]" value="{{ $cart->id }}">
                                <input type="hidden" name="items[{{ $index }}][quantity]" value="{{ $cart->checkout_quantity }}">
                            @endforeach
                        @endif

                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="ship-name">Nama Lengkap Penerima</label>
                            <input class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none placeholder:text-outline-variant focus:bg-surface-container-lowest transition-colors" id="ship-name" name="shipping_name" placeholder="Nama lengkap penerima paket" type="text" value="{{ old('shipping_name', auth()->user()->name ?? '') }}" required>
                        </div>
                        {{-- Nomor Telepon --}}
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="ship-phone">Nomor WhatsApp / Telepon</label>
                            <input class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none placeholder:text-outline-variant focus:bg-surface-container-lowest transition-colors" id="ship-phone" name="shipping_phone" placeholder="08xx-xxxx-xxxx" type="tel" value="{{ old('shipping_phone') }}" required>
                        </div>
                        {{-- Alamat Lengkap --}}
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="ship-address">Alamat Lengkap</label>
                            <textarea class="w-full px-3.5 py-2.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none placeholder:text-outline-variant focus:bg-surface-container-lowest transition-colors resize-none" id="ship-address" name="shipping_address" placeholder="Jalan, nomor rumah, RT/RW, kelurahan..." rows="3" required>{{ old('shipping_address') }}</textarea>
                        </div>
                        {{-- Catatan Kurir --}}
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface mb-1.5" for="ship-notes">Catatan untuk Kurir (opsional)</label>
                            <input class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none placeholder:text-outline-variant focus:bg-surface-container-lowest transition-colors" id="ship-notes" name="notes" placeholder="Misalnya: pagar warna hitam, titip satpam..." type="text" value="{{ old('notes') }}">
                        </div>
                    
                </div>

                {{-- Kartu Metode Pembayaran --}}
                <div class="bg-surface-container-lowest p-space-lg rounded-lg shadow-sm">
                    <div class="flex items-center gap-space-sm mb-space-lg">
                        <span class="material-symbols-outlined text-primary text-headline-sm">payments</span>
                        <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold">Metode Pembayaran</h2>
                    </div>
                    <div class="space-y-space-sm">
                        {{-- Opsi COD --}}
                        <label class="flex items-center gap-space-md p-space-md bg-surface-container-low rounded-lg cursor-pointer transition-colors border-2 border-primary payment-option">
                            <input checked class="sr-only" name="payment_method" type="radio" value="cod" onchange="updatePaymentUI()">
                            <div class="w-5 h-5 rounded-full border-2 border-primary flex items-center justify-center shrink-0 radio-circle transition-colors">
                                <div class="w-3 h-3 rounded-full bg-primary opacity-100 radio-dot transition-opacity"></div>
                            </div>
                            <div class="flex-1">
                                <span class="font-label-lg text-label-lg font-semibold text-on-surface flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-body-md">local_shipping</span>
                                    Bayar di Tempat (COD)
                                </span>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Bayar tunai langsung ke kurir saat barang tiba di rumah Anda.</p>
                            </div>
                        </label>
                        {{-- Opsi Transfer --}}
                        <label class="flex items-center gap-space-md p-space-md bg-surface-container-low rounded-lg cursor-pointer transition-colors border-2 border-transparent payment-option">
                            <input class="sr-only" name="payment_method" type="radio" value="transfer" onchange="updatePaymentUI()">
                            <div class="w-5 h-5 rounded-full border-2 border-outline flex items-center justify-center shrink-0 radio-circle transition-colors">
                                <div class="w-3 h-3 rounded-full bg-primary opacity-0 radio-dot transition-opacity"></div>
                            </div>
                            <div class="flex-1">
                                <span class="font-label-lg text-label-lg font-semibold text-on-surface flex items-center gap-space-xs">
                                    <span class="material-symbols-outlined text-body-md">account_balance</span>
                                    Transfer Bank (Virtual Account)
                                </span>
                                <p class="font-body-sm text-body-sm text-on-surface-variant mt-0.5">Bayar melalui BCA, Mandiri, BNI, atau BRI Virtual Account.</p>
                            </div>
                        </label>
                    </div>
                </div>
                </form>
            </div>

            {{-- Kolom Kanan: Ringkasan Pesanan --}}
            <div class="lg:col-span-5 flex flex-col gap-space-lg">
                <div class="bg-surface-container-lowest p-space-lg rounded-lg shadow-sm sticky top-20">
                    <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-md">Ringkasan Pesanan</h2>

                    {{-- Daftar Item --}}
                    <div class="space-y-space-md mb-space-lg">
                        @if(isset($book))
                        <div class="flex gap-space-md p-space-sm bg-surface-container-low rounded-lg">
                            <div class="w-14 h-20 bg-surface-container-highest shrink-0 overflow-hidden rounded">
                                <img alt="{{ $book->title }}" class="w-full h-full object-cover" src="{{ $book->cover_image }}">
                            </div>
                            <div class="flex-1">
                                <h3 class="font-label-lg text-label-lg text-on-surface font-semibold line-clamp-1">{{ $book->title }}</h3>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $book->author }}</p>
                                <div class="flex items-center justify-between mt-space-xs">
                                    <span class="font-body-sm text-body-sm text-on-surface-variant">1×</span>
                                    <span class="font-label-lg text-label-lg text-on-surface font-semibold">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        @elseif(isset($carts) && $carts->count() > 0)
                            @foreach($carts as $cart)
                            <div class="flex gap-space-md p-space-sm bg-surface-container-low rounded-lg mb-2">
                                <div class="w-14 h-20 bg-surface-container-highest shrink-0 overflow-hidden rounded">
                                    <img alt="{{ $cart->book->title }}" class="w-full h-full object-cover" src="{{ $cart->book->cover_image }}">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-label-lg text-label-lg text-on-surface font-semibold line-clamp-1">{{ $cart->book->title }}</h3>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant">{{ $cart->book->author }}</p>
                                    <div class="flex items-center justify-between mt-space-xs">
                                        <span class="font-body-sm text-body-sm text-on-surface-variant">{{ $cart->checkout_quantity }}×</span>
                                        <span class="font-label-lg text-label-lg text-on-surface font-semibold">Rp {{ number_format($cart->book->price * $cart->checkout_quantity, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <p class="text-sm text-on-surface-variant">Keranjang belanja kosong.</p>
                        @endif
                    </div>

                    {{-- Rincian Harga --}}
                    <div class="space-y-space-xs pt-space-md border-t border-surface-container-highest">
                        <div class="flex justify-between font-body-sm text-body-sm text-on-surface-variant">
                            <span>Subtotal barang</span>
                            <span class="text-on-surface">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between font-body-sm text-body-sm text-on-surface-variant">
                            <span>Biaya Pengiriman</span>
                            <span class="text-on-surface">Rp 0</span>
                        </div>
                    </div>

                    {{-- Total Akhir --}}
                    <div class="mt-space-md pt-space-md border-t border-surface-container-highest">
                        <div class="flex justify-between items-baseline">
                            <div>
                                <span class="font-headline-sm text-headline-sm text-on-surface font-semibold block">Total</span>
                                <span class="font-label-sm text-label-sm text-on-surface-variant" id="payment-description">Bayar saat kurir tiba (COD)</span>
                            </div>
                            <span class="font-headline-md text-headline-md text-on-surface font-bold">Rp {{ number_format($totalAmount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-space-lg">
                        <button type="submit" form="shipping-form" id="submit-btn" class="w-full block text-center py-space-sm bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold hover:bg-primary/90 transition-opacity disabled:opacity-50" @if(!isset($book) && (!isset($carts) || $carts->count() == 0)) disabled @endif>
                            Konfirmasi Pesanan COD
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updatePaymentUI() {
    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
    const paymentDescription = document.getElementById('payment-description');
    const submitBtn = document.getElementById('submit-btn');

    paymentMethods.forEach(radio => {
        const label = radio.closest('.payment-option');
        const circle = label.querySelector('.radio-circle');
        const dot = label.querySelector('.radio-dot');
        
        if (radio.checked) {
            label.classList.remove('border-transparent');
            label.classList.add('border-primary', 'bg-surface-container');
            circle.classList.remove('border-outline');
            circle.classList.add('border-primary');
            dot.classList.remove('opacity-0');
            dot.classList.add('opacity-100');
            
            if (radio.value === 'cod') {
                paymentDescription.textContent = 'Bayar saat kurir tiba (COD)';
                submitBtn.textContent = 'Konfirmasi Pesanan COD';
            } else {
                paymentDescription.textContent = 'Transfer Bank (Virtual Account)';
                submitBtn.textContent = 'Lanjutkan Pembayaran';
            }
        } else {
            label.classList.add('border-transparent');
            label.classList.remove('border-primary', 'bg-surface-container');
            circle.classList.add('border-outline');
            circle.classList.remove('border-primary');
            dot.classList.add('opacity-0');
            dot.classList.remove('opacity-100');
        }
    });
}
</script>
@endpush
