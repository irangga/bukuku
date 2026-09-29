<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

// ==========================================
// USER ROUTES (PUBLIC)
// ==========================================

Route::get('/', [PageController::class, 'home']);
Route::get('/katalog', [PageController::class, 'catalog']);
Route::get('/buku/{slug}', [PageController::class, 'bookDetail']);
Route::get('/tentang-kami', [PageController::class, 'about']);
Route::get('/kontak', [PageController::class, 'contact']);
Route::post('/kontak/kirim', [PageController::class, 'submitContact'])->middleware('throttle:3,1');

// ==========================================
// CART ROUTES (AUTH)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/keranjang', [\App\Http\Controllers\CartController::class, 'index']);
    Route::post('/keranjang/tambah', [\App\Http\Controllers\CartController::class, 'add']);
    Route::delete('/keranjang/hapus/{cart_id}', [\App\Http\Controllers\CartController::class, 'destroy']);
});

// Checkout flow
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout/process', [CheckoutController::class, 'process'])->middleware('throttle:5,1');
Route::get('/pesanan-diterima', [CheckoutController::class, 'success']);

use App\Http\Controllers\AuthController;

// ==========================================
// AUTH ROUTES (GUEST)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ==========================================
// ADMIN ROUTES
// ==========================================

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/pesanan', [OrderController::class, 'index'])->name('pesanan.index');
    Route::put('/pesanan/{id}', [OrderController::class, 'update'])->name('pesanan.update');
    Route::delete('/pesanan/{id}', [OrderController::class, 'destroy'])->name('pesanan.destroy');
    
    Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna.index');
    Route::get('/pengguna/{id}', [UserController::class, 'show'])->name('pengguna.show');
    Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('pengguna.destroy');
    
    Route::get('/pesan-masuk', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('pesan.index');
    Route::delete('/pesan-masuk/{id}', [\App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('pesan.destroy');
    
    Route::resource('kategori', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('buku', \App\Http\Controllers\Admin\BookController::class);
    
    // Fallback
    Route::get('/{any}', [DashboardController::class, 'index'])->where('any', '.*');
});
