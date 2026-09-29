# BUKUKU - Toko Buku Daring Minimalis Indonesia 📚

**BUKUKU** adalah sebuah platform *e-commerce* modern yang dirancang khusus untuk memenuhi kebutuhan literasi masyarakat Indonesia. Proyek ini memfasilitasi penjualan buku fisik berkualitas secara *online*, menyediakan katalog yang dikurasi dari penerbit terkemuka, dengan sistem pembelian yang ringkas dan aman. 

Proyek ini bertujuan untuk mengatasi masalah aksesibilitas bahan bacaan dengan menyediakan dukungan sistem pengiriman yang inklusif, seperti *Cash on Delivery (COD)* dan metode Transfer Bank. Desainnya menitikberatkan pada antarmuka minimalis, bersih, dan fungsional, untuk mengutamakan fokus pada buku itu sendiri.

---

## 🌟 Fitur Utama (Features)

Aplikasi BUKUKU memiliki dua sisi sistem utama, yaitu untuk *Pelanggan* (End-User) dan *Administrator*.

**Untuk Pelanggan:**
- **Katalog Terbuka:** Cari, saring (filter) berdasarkan kategori, dan jelajahi buku dengan antarmuka yang sangat responsif.
- **Keranjang Belanja (Shopping Cart):** Sistem keranjang belanja dinamis tanpa mengganggu proses *window shopping*.
- **Checkout Dinamis & Aman:** Transaksi aman dengan verifikasi harga terpusat di server (mencegah eksploitasi harga dari klien), dan dukungan multi-pembayaran (COD & Transfer Bank).
- **Desain Responsif:** Dukungan penuh untuk seluler, tablet, hingga layar laptop/desktop besar menggunakan komponen dari Alpine.js dan Tailwind CSS.

**Untuk Administrator:**
- **Dasbor Statistik:** Pantau total pesanan hari ini, total pendapatan, jumlah buku, dan pendaftar pengguna baru.
- **Manajemen Katalog (CRUD Buku & Kategori):** Tambah, ubah, dan hapus kategori serta rincian buku (judul, harga, stok, sampul, penerbit, dsb).
- **Manajemen Pesanan:** Tinjau data pesanan masuk, pantau status (Menunggu, Dikemas, Dikirim, Selesai, Dibatalkan), serta instruksi dan catatan dari pembeli.
- **Manajemen Pengguna:** Peninjauan akun pelanggan untuk melihat detail serta hak akses hapus akun pengguna yang bermasalah.

---

## 💻 Teknologi yang Digunakan (Tech Stack)

Aplikasi dibangun di atas pondasi *framework* modern untuk memastikan skalabilitas, keamanan, dan pengalaman pengguna yang luar biasa:
- **Backend:** Laravel (PHP Framework)
- **Frontend / Styling:** Tailwind CSS (Vanilla Utility-First CSS)
- **Interaktivitas (JS):** Alpine.js (Untuk state ringan seperti Navbar, Dropdown, Toggle Sidebar)
- **Database:** SQLite (Default untuk *local development*) atau MySQL / PostgreSQL.
- **Iconography:** Google Material Symbols (Rounded)

---

## ⚙️ Prasyarat Sistem (Prerequisites)

Sebelum melakukan instalasi proyek secara lokal, pastikan perangkat komputer/server Anda telah memiliki:
- **PHP** versi 8.2 atau yang lebih baru.
- **Composer** (Dependency Manager untuk PHP).
- **Node.js** dan **npm** (Untuk mengkompilasi *assets* Tailwind).
- Akses ke Terminal (Git Bash / PowerShell / Terminal Unix).

---

## 🚀 Instruksi Instalasi (Installation Guide)

Ikuti langkah-langkah berurutan di bawah ini untuk menjalankan aplikasi BUKUKU di komputer lokal (Localhost):

1. **Kloning Repositori**
   ```bash
   git clone https://github.com/irangga/bukuku.git
   cd bukuku
   ```

2. **Instal Dependensi Backend (PHP)**
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend (Node.js)**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin file konfigurasi bawaan dan sesuaikan kredensial jika perlu:
   ```bash
   cp .env.example .env
   ```

5. **Kompilasi Aset Frontend (Tailwind)**
   ```bash
   npm run build
   # Atau jika Anda sedang dalam tahap pengembangan (live-reload): npm run dev
   ```

6. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

7. **Migrasi Database & Seeding Dummy Data**
   Jalankan perintah ini untuk membuat struktur tabel database dan mengisinya dengan buku, kategori, serta akun demo:
   ```bash
   php artisan migrate --seed
   ```

8. **Jalankan Development Server**
   ```bash
   php artisan serve
   ```
   *Aplikasi kini bisa diakses melalui browser pada `http://127.0.0.1:8000`.*

---

## 🔑 Kredensial Pengujian (Demo Access)

Data telah di-*seeding* ke dalam sistem. Anda dapat langsung masuk dengan rincian berikut:

**Akun Administrator (Akses Penuh):**
- **Email:** `admin@bukuku.test`
- **Password:** `password`

**Akun Pelanggan (User Biasa):**
- **Email:** `danang@bukuku.test`
- **Password:** `password`

---

## 📂 Struktur Direktori Penting

Jika Anda merupakan kontributor atau pengembang yang ingin menelusuri sumber kode, berikut adalah panduan direktori utama proyek ini:

```
bukuku/
 ├── app/
 │    ├── Http/Controllers/       # Logika bisnis (AdminController, CheckoutController, dll)
 │    └── Models/                 # Relasi database (Book, Category, Cart, Order, User)
 ├── database/
 │    ├── migrations/             # Skema tabel database (Blueprint)
 │    └── seeders/                # Logika injeksi data dummy (DatabaseSeeder.php)
 ├── resources/
 │    ├── css/                    # Direktori input Tailwind (app.css)
 │    └── views/                  # UI Web (Blade Templates)
 │         ├── admin/             # Layar dashboard dan tabel admin
 │         ├── components/        # Sidebar admin, Topbar admin, Header pengguna (Reusable)
 │         └── layouts/           # Template utama (app.blade.php dan admin.blade.php)
 ├── routes/
 │    └── web.php                 # Pendaftaran daftar rute (Web dan API lokal)
 └── tailwind.config.js           # Konfigurasi utility, token warna, dan plugin Tailwind
```

---

## 📜 Lisensi & Kontak

Proyek ini diilisensi di bawah [MIT License](https://opensource.org/licenses/MIT). Anda bebas untuk menyalin, memodifikasi, dan mendistribusikan kode ini, dengan menyertakan pemberitahuan hak cipta asli.

- **Kreator/Organisasi:** BUKUKU Pustaka Indonesia
- **Email:** iranggaawan@gmail.com
- **Hak Cipta:** © 2026 BUKUKU. Hak cipta dilindungi undang-undang.
