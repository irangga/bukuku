<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\User;
use App\Models\Book;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman utama panel admin dengan ringkasan metrik.
     * Eager loading digunakan pada relasi user untuk pesanan terbaru.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $metrics = [
            'total_orders' => Order::whereDate('created_at', today())->count(),
            'total_revenue' => Order::whereDate('created_at', today())->sum('total_amount'),
            'new_users' => User::where('is_admin', false)->count(),
            'total_books' => Book::count(),
        ];
        
        $recent_orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('metrics', 'recent_orders'));
    }
}
