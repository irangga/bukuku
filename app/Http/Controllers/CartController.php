<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan daftar keranjang pengguna.
     * Menerapkan Eager Loading (with 'book') untuk mencegah N+1 query.
     */
    public function index()
    {
        $carts = Cart::with('book')
            ->where('user_id', Auth::id())
            ->get();
            
        return view('keranjang_belanja', compact('carts'));
    }

    /**
     * Menambahkan buku ke dalam keranjang.
     */
    public function add(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('book_id', $request->book_id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'book_id' => $request->book_id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function destroy($cart_id)
    {
        $cart = Cart::where('user_id', Auth::id())->where('id', $cart_id)->firstOrFail();
        $cart->delete();

        return redirect('/keranjang')->with('success', 'Buku dihapus dari keranjang.');
    }
}
