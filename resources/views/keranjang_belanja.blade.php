{{--
|--------------------------------------------------------------------------
| Halaman Keranjang Belanja
|--------------------------------------------------------------------------
| Menampilkan daftar buku yang telah ditambahkan pengguna ke keranjang.
| Sesuai dengan UI Guidelines Bukuku.
|--------------------------------------------------------------------------
--}}
@extends('layouts.app')

@section('title', 'Keranjang Belanja — BUKUKU')

@section('content')
<div class="w-full bg-surface-container-lowest py-space-xl min-h-screen">
    <div class="max-w-7xl mx-auto px-6">
        
        {{-- Judul Halaman --}}
        <div class="mb-space-xl">
            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight mb-2">Keranjang Belanja</h1>
            <p class="font-body-md text-body-md text-on-surface-variant">Periksa kembali buku pilihan Anda sebelum melanjutkan ke pembayaran.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
            
            {{-- Bagian Kiri: Daftar Produk di Keranjang --}}
            <div class="lg:col-span-8 flex flex-col gap-space-md" id="cart-items-container">
                
                {{-- Aksi Bulk: Pilih Semua & Hapus Terpilih --}}
                <div class="flex items-center gap-space-sm pb-space-sm border-b border-outline-variant/30">
                    <input type="checkbox" id="select-all" class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary cursor-pointer" checked>
                    <label for="select-all" class="font-label-md text-label-md text-on-surface cursor-pointer">Pilih Semua</label>
                    <button type="button" id="delete-selected" class="ml-auto text-error font-label-sm text-label-sm hover:text-error/80 transition-colors hidden sm:block">Hapus Terpilih</button>
                </div>

                @forelse($carts as $cart)
                <div class="cart-item bg-surface-container-low rounded-xl p-space-md flex flex-col sm:flex-row gap-space-md items-center sm:items-start relative" data-price="{{ $cart->book->price }}" data-cart-id="{{ $cart->id }}">
                    <input type="checkbox" class="item-checkbox absolute top-space-md left-space-md sm:relative sm:top-0 sm:left-0 w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary cursor-pointer mt-1" checked>
                    
                    {{-- Gambar Buku --}}
                    <div class="w-24 aspect-[3/4] bg-surface-container-high rounded-md overflow-hidden shrink-0 mt-4 sm:mt-0">
                        <img src="{{ $cart->book->cover_image }}" alt="{{ $cart->book->title }}" class="w-full h-full object-cover">
                    </div>

                    {{-- Detail Item --}}
                    <div class="flex-1 w-full text-center sm:text-left">
                        <a href="{{ url('/buku/' . $cart->book->slug) }}" class="font-headline-sm text-headline-sm text-on-surface hover:text-primary transition-colors block mb-1">{{ $cart->book->title }}</a>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mb-space-sm">{{ $cart->book->author }}</p>
                        <div class="font-label-lg text-label-lg font-bold text-on-surface mb-space-md item-price-display">Rp {{ number_format($cart->book->price, 0, ',', '.') }}</div>

                        {{-- Kontrol Kuantitas & Hapus --}}
                        <div class="flex items-center justify-center sm:justify-start gap-space-md">
                            <div class="flex items-center bg-surface-container rounded-lg overflow-hidden border border-outline-variant">
                                <button type="button" class="btn-minus px-3 py-1 hover:bg-surface-container-high text-on-surface transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">remove</span>
                                </button>
                                <span class="item-quantity px-4 font-label-md text-label-md">{{ $cart->quantity }}</span>
                                <button type="button" class="btn-plus px-3 py-1 hover:bg-surface-container-high text-on-surface transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">add</span>
                                </button>
                            </div>
                            <form action="{{ url('/keranjang/hapus/' . $cart->id) }}" method="POST" class="inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete text-error hover:text-error/80 flex items-center gap-1 font-label-sm text-label-sm transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="py-12 text-center text-on-surface-variant">
                    <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">shopping_cart</span>
                    <p>Keranjang belanja Anda masih kosong.</p>
                </div>
                @endforelse

            </div>

            {{-- Bagian Kanan: Ringkasan Belanja --}}
            <div class="lg:col-span-4">
                <div class="bg-surface-container rounded-xl p-space-lg sticky top-24 shadow-sm border border-outline-variant/30">
                    <h2 class="font-headline-sm text-headline-sm text-on-surface font-semibold mb-space-md">Ringkasan Belanja</h2>
                    
                    <div class="flex flex-col gap-space-sm mb-space-lg">
                        <div class="flex justify-between items-center text-on-surface-variant font-body-md text-body-md">
                            <span id="summary-items-count">Total Harga (0 barang)</span>
                            <span id="summary-subtotal">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center text-on-surface-variant font-body-md text-body-md">
                            <span>Estimasi Ongkos Kirim</span>
                            <span class="text-primary font-medium">Gratis</span>
                        </div>
                    </div>

                    <div class="border-t border-outline-variant/50 pt-space-md mb-space-lg flex justify-between items-center">
                        <span class="font-label-lg text-label-lg font-bold text-on-surface">Total Tagihan</span>
                        <span class="font-headline-sm text-headline-sm font-bold text-primary" id="summary-total">Rp 0</span>
                    </div>

                    <form action="{{ url('/checkout') }}" method="GET" id="checkout-form">
                        <div id="checkout-inputs"></div>
                        <button type="submit" id="btn-checkout" class="w-full py-space-sm bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center hover:bg-primary/90 transition-opacity shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                            Lanjut ke Pembayaran
                        </button>
                    </form>
                    
                    <p class="font-body-sm text-body-sm text-on-surface-variant text-center mt-space-sm flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">verified</span>
                        Bisa Bayar di Tempat (COD)
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Vanilla JavaScript untuk Interaktivitas Keranjang --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const summaryItemsCount = document.getElementById('summary-items-count');
        const summarySubtotal = document.getElementById('summary-subtotal');
        const summaryTotal = document.getElementById('summary-total');
        const btnDeleteSelected = document.getElementById('delete-selected');
        const btnCheckout = document.getElementById('btn-checkout');

        // Helper: Format angka menjadi format Rupiah
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number).replace('Rp', 'Rp ');
        }

        // Helper: Kalkulasi Ulang Total Berdasarkan Pilihan & Kuantitas
        function calculateTotal() {
            const items = document.querySelectorAll('.cart-item');
            const checkoutInputs = document.getElementById('checkout-inputs');
            let total = 0;
            let selectedCount = 0;
            let allChecked = true;
            let hasItems = items.length > 0;
            
            checkoutInputs.innerHTML = ''; // Reset inputs

            let index = 0;
            items.forEach(item => {
                const checkbox = item.querySelector('.item-checkbox');
                const price = parseInt(item.getAttribute('data-price'), 10);
                const quantity = parseInt(item.querySelector('.item-quantity').innerText, 10);
                const cartId = item.getAttribute('data-cart-id');

                if (checkbox.checked) {
                    total += (price * quantity);
                    selectedCount += quantity;
                    
                    // Tambahkan input hidden untuk form checkout
                    checkoutInputs.insertAdjacentHTML('beforeend', `
                        <input type="hidden" name="items[${index}][cart_id]" value="${cartId}">
                        <input type="hidden" name="items[${index}][quantity]" value="${quantity}">
                    `);
                    index++;
                } else {
                    allChecked = false;
                }
            });

            // Update status 'Select All' checkbox
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = hasItems ? allChecked : false;
            }

            // Update UI Ringkasan Belanja
            summaryItemsCount.innerText = `Total Harga (${selectedCount} barang)`;
            summarySubtotal.innerText = formatRupiah(total);
            summaryTotal.innerText = formatRupiah(total);

            // Disable checkout jika tidak ada item terpilih
            if (selectedCount === 0) {
                btnCheckout.disabled = true;
            } else {
                btnCheckout.disabled = false;
            }
        }

        // Event Listener: Select All Checkbox
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function(e) {
                const isChecked = e.target.checked;
                const checkboxes = document.querySelectorAll('.item-checkbox');
                checkboxes.forEach(cb => {
                    cb.checked = isChecked;
                });
                calculateTotal();
            });
        }

        // Event Listener: Delegasi event container untuk klik tombol/checkbox individual
        if (cartItemsContainer) {
            cartItemsContainer.addEventListener('click', function(e) {
                // Handle Checkbox Individual
                if (e.target.classList.contains('item-checkbox')) {
                    calculateTotal();
                }

                // Handle Tombol Plus (+)
                const btnPlus = e.target.closest('.btn-plus');
                if (btnPlus) {
                    const item = btnPlus.closest('.cart-item');
                    const qtyEl = item.querySelector('.item-quantity');
                    let qty = parseInt(qtyEl.innerText, 10);
                    qty++;
                    qtyEl.innerText = qty;
                    calculateTotal();
                }

                // Handle Tombol Minus (-)
                const btnMinus = e.target.closest('.btn-minus');
                if (btnMinus) {
                    const item = btnMinus.closest('.cart-item');
                    const qtyEl = item.querySelector('.item-quantity');
                    let qty = parseInt(qtyEl.innerText, 10);
                    if (qty > 1) {
                        qty--;
                        qtyEl.innerText = qty;
                        calculateTotal();
                    }
                }

                // Handle Tombol Hapus Individual
                const btnDelete = e.target.closest('.btn-delete');
                if (btnDelete) {
                    if (confirm('Hapus buku ini dari keranjang?')) {
                        const form = btnDelete.closest('form.delete-form');
                        if (form) {
                            form.submit();
                        } else {
                            const item = btnDelete.closest('.cart-item');
                            item.remove();
                            calculateTotal();
                        }
                    }
                }
            });
        }

        // Event Listener: Tombol Hapus Terpilih
        if (btnDeleteSelected) {
            btnDeleteSelected.addEventListener('click', function() {
                const selectedItems = document.querySelectorAll('.item-checkbox:checked');
                if (selectedItems.length === 0) {
                    alert('Tidak ada buku yang dipilih untuk dihapus.');
                    return;
                }
                
                if (confirm(`Hapus ${selectedItems.length} buku terpilih dari keranjang?`)) {
                    // For now, since we only have single delete routes, we might need a bulk delete, 
                    // or just submit the first one if it's a simple setup. Ideally AJAX.
                    // For simplicity, submit the first selected form.
                    const firstForm = selectedItems[0].closest('.cart-item').querySelector('form.delete-form');
                    if(firstForm) firstForm.submit();
                }
            });
        }

        // Initial Calculation saat halaman dimuat
        calculateTotal();
    });
</script>
    </div>
</div>
@endsection
