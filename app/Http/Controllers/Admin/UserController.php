<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna reguler (non-admin) di panel admin.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('is_admin', false)->latest()->paginate(10);
        return view('admin.pengguna', compact('users'));
    }

    /**
     * Menampilkan detail pengguna dan riwayat pesanannya.
     */
    public function show($id)
    {
        $user = User::with(['orders' => function($query) {
            $query->with('items.book')->latest();
        }])->findOrFail($id);
        
        return view('admin.pengguna-detail', compact('user'));
    }

    /**
     * Menghapus pengguna dan data terkait.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
