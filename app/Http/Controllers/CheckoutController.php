<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CheckoutRequest;
use App\Models\Order;

use App\Models\Book;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman formulir checkout (COD).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $book = null;
        $carts = collect();
        $totalAmount = 0;

        // Jika checkout dari 1 buku (beli langsung)
        if ($request->query('book_id')) {
            $book = Book::findOrFail($request->query('book_id'));
            $totalAmount = $book->price;
        } 
        // Jika checkout dari keranjang belanja
        else if ($request->query('items')) {
            $cartIds = collect($request->query('items'))->pluck('cart_id');
            $carts = \App\Models\Cart::with('book')
                ->whereIn('id', $cartIds)
                ->where('user_id', auth()->id())
                ->get();
            
            // Re-assign quantity from request
            $requestItems = collect($request->query('items'))->keyBy('cart_id');
            foreach ($carts as $cart) {
                $cart->checkout_quantity = $requestItems[$cart->id]['quantity'] ?? 1;
                $totalAmount += $cart->book->price * $cart->checkout_quantity;
            }
        } else {
            return redirect('/');
        }
        
        return view('checkout', compact('book', 'carts', 'totalAmount'));
    }

    /**
     * Memproses data pesanan baru dari pengguna.
     * Menggunakan DB::transaction untuk mencegah data inkonsisten.
     *
     * @param  \App\Http\Requests\CheckoutRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(CheckoutRequest $request)
    {
        $data = $request->validated();
        
        $order = \Illuminate\Support\Facades\DB::transaction(function () use ($data, $request) {
            $totalAmount = 0;
            $itemsData = [];

            // Skenario 1: Beli Langsung (1 buku)
            if ($request->has('book_id')) {
                $book = Book::findOrFail($request->book_id);
                $totalAmount = $book->price; // Total harga diambil dari database (Aman)
                
                $itemsData[] = [
                    'book' => $book,
                    'quantity' => 1,
                    'price' => $book->price,
                ];
            } 
            // Skenario 2: Beli dari Keranjang (Banyak buku)
            else if ($request->has('items')) {
                $cartIds = collect($request->items)->pluck('cart_id');
                // Mengambil keranjang beserta buku, hanya milik user yang sedang login
                $carts = \App\Models\Cart::with('book')
                    ->whereIn('id', $cartIds)
                    ->where('user_id', auth()->id())
                    ->get();
                
                // Mengubah req items ke array yg mudah dicari
                $requestItems = collect($request->items)->keyBy('cart_id');

                foreach ($carts as $cart) {
                    $reqQty = $requestItems[$cart->id]['quantity'];
                    $subTotal = $cart->book->price * $reqQty;
                    $totalAmount += $subTotal; // Kalkulasi total dengan harga DB (Aman)

                    $itemsData[] = [
                        'book' => $cart->book,
                        'quantity' => $reqQty,
                        'price' => $cart->book->price,
                        'cart_id' => $cart->id,
                    ];
                }
            }

            // Memastikan data valid untuk Order
            $data['order_number'] = 'ORD-' . strtoupper(uniqid());
            $data['total_amount'] = $totalAmount; 
            
            if (auth()->check()) {
                $data['user_id'] = auth()->id();
            }
            
            // 1. Buat Order Utama
            $order = Order::create($data);
            
            // 2. Buat Order Item dan Kurangi Stok Buku
            foreach ($itemsData as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $item['book']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
                
                // Kurangi stok di DB
                $item['book']->decrement('stock', $item['quantity']);

                // 3. Hapus item dari Cart jika checkout via Cart
                if (isset($item['cart_id'])) {
                    \App\Models\Cart::destroy($item['cart_id']);
                }
            }

            return $order;
        });

        return redirect('/pesanan-diterima')->with('order_id', $order->id);
    }

    /**
     * Menampilkan halaman sukses setelah pesanan berhasil dibuat.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function success()
    {
        $orderId = session('order_id');
        if (!$orderId) {
            return redirect('/');
        }
        
        $order = Order::with('items.book')->findOrFail($orderId);
        return view('pesanan-diterima', compact('order'));
    }
}
