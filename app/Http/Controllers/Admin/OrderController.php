<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar seluruh pesanan di panel admin.
     * Mencegah query N+1 dengan melakukan eager loading pada relasi user dan items.book.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Order::with('user', 'items.book')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('shipping_name', 'like', "%{$search}%")
                  ->orWhere('shipping_address', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        $countMenunggu = Order::where('status', 'menunggu')->count();
        $countDikemas = Order::where('status', 'dikemas')->count();
        $countDikirim = Order::where('status', 'dikirim')->count();

        return view('admin.pesanan', compact('orders', 'countMenunggu', 'countDikemas', 'countDikirim'));
    }

    /**
     * Memperbarui status pesanan.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:menunggu,dikemas,dikirim']);
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Menghapus pesanan.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }
}
