<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin & Pelanggan Dummy
        $admin = User::create([
            'name' => 'Admin Bukuku',
            'email' => 'admin@bukuku.test',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $customer = User::create([
            'name' => 'Danang',
            'email' => 'danang@bukuku.test',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // 2. Buat Kategori
        $katSastra = Category::create(['name' => 'Sastra', 'slug' => 'sastra']);
        $katFilsafat = Category::create(['name' => 'Filsafat', 'slug' => 'filsafat']);
        $katTeknologi = Category::create(['name' => 'Teknologi', 'slug' => 'teknologi']);
        $katDiri = Category::create(['name' => 'Pengembangan Diri', 'slug' => 'pengembangan-diri']);

        // 3. Buat Buku
        $buku1 = Book::create([
            'category_id' => $katSastra->id,
            'title' => 'Cantik Itu Luka',
            'slug' => Str::slug('Cantik Itu Luka'),
            'author' => 'Eka Kurniawan',
            'publisher' => 'Gramedia Pustaka Utama',
            'description' => 'Buku ini adalah mahakarya sastra Indonesia kontemporer yang menggabungkan unsur sejarah, romansa, dan tragedi dalam gaya realisme magis.',
            'price' => 125000,
            'stock' => 50,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuALj1VLgWl27qdX4hyy1qN-l227CoU0LvJ8ZTo5C9pI3cFkr58_3pywJjIYh14oCNBctxJs4lHFgJsQOfl1T4i-I7PBGnmf7ED7oVYbqZIGye3eUU5QeO75uWVH4zqo1Jvl1VFfYp7JC5ZwXLm6QDRT-8hoM5qMUTOSbbt_qutSmLhIw9sHiJy-ZGrlC0DDhspMQ6nS3u__KVjDwEh4XsfP0ANOjG1gtCywnB5WtA7zpI2soj0jmMzF2g',
        ]);

        $buku2 = Book::create([
            'category_id' => $katFilsafat->id,
            'title' => 'Filosofi Teras',
            'slug' => Str::slug('Filosofi Teras'),
            'author' => 'Henry Manampiring',
            'publisher' => 'Buku Kompas',
            'description' => 'Filsafat kuno Stoikisme untuk kehidupan Indonesia yang modern dan anti baper.',
            'price' => 98000,
            'stock' => 100,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC0-pvSYjhK06ItvzTyrxsSb1ECN4gYaUx4Vu9H-gDS6f2A3U8sNOWwLiDUGt4TDBr9XNzVDzgkceRHLHLp592hxw8NLt2Wb6Vx8xDyuZmEt8wslqNk8h9fyGutjKuvy1P-nqiXQd9gqNkVzWORaBMUVSYClgos87owAwNGqSERJrfHdycUBCNwA3lpewpyFeN5oUe0XlZR7LqFFHp5_6e2PbDQFxcg5d5LzeknJn6L5y2z2eM4cduPAg',
        ]);

        $buku3 = Book::create([
            'category_id' => $katSastra->id,
            'title' => 'Bumi Manusia',
            'slug' => Str::slug('Bumi Manusia'),
            'author' => 'Pramoedya Ananta Toer',
            'publisher' => 'Lentera Dipantara',
            'description' => 'Buku pertama dari Tetralogi Buru yang legendaris.',
            'price' => 138000,
            'stock' => 75,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBTgh9ydGZETZe0JtNafuzOdfMApW9Ye4lyebJMD8E4dknpgdqnkDHY0a7J-sb72HiAZoiW3sn4PGJVHe8f2ok7NbBHJPchtSj5pwYngkUSzUY2LoMZ5idbjEujcmPkyH4mFKtRMbakCt7WzlDWBW73Ox-SVLD-RSZycecrppPhyJ4oHYy7GQGe6RTgL9P41rYh5Xa95xrkI6uHuCSY98wVqKyHMom7CxgPJfN4mGoie-sV2JNnWnVKMg',
        ]);

        $buku4 = Book::create([
            'category_id' => $katSastra->id,
            'title' => 'Laut Bercerita',
            'slug' => Str::slug('Laut Bercerita'),
            'author' => 'Leila S. Chudori',
            'publisher' => 'KPG',
            'description' => 'Novel tentang persahabatan, cinta, keluarga, dan kehilangan di era orde baru.',
            'price' => 133000,
            'stock' => 120,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvPoTcG5fvO3Rp0Q916RvlTCHLDgsdmwJ8S-EtOjhfQy9UurmiTTxb6ttx8-nTwDcEsv5a3xpHxSAB43SpQzy0mlQAzSSqomR3fYd50OXwsyoIBZ6dlf4xHjIoclJK7Ys6eeNQYTAlGUQwnAboNa0rNfnk1NkQ3bWeBC0atDfn19ZlWhBTLq5VI_G6HGIsiSb8UyUawX_-1xTItwb13P6O3310fwgX2-U87Gc5PH1d8n1iBKHI_CdfJQ',
        ]);

        $buku5 = Book::create([
            'category_id' => $katTeknologi->id,
            'title' => 'Clean Code',
            'slug' => Str::slug('Clean Code'),
            'author' => 'Robert C. Martin',
            'publisher' => 'Prentice Hall',
            'description' => 'A Handbook of Agile Software Craftsmanship.',
            'price' => 210000,
            'stock' => 30,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBZgcCz-PYOPlq7HpSF9qqeUtUr0Sl1u8mnjGacbqTrdwcu6sWVeg-97m9tFlmFUu2lm8CzqRzkof6cGdzPfDzdWAte4hSgidKaTDz7-H1p4CFR29MDA54-vN-OL82M4pfDkzisSbBT5_rFHyxp1gBdhucfzF8heIU6U0woWiL8d09tjFM6JVltcP__JWmk6YTqGK56-0MnXU0byCCeJg-xYzxr_QKPxnkD9j9mGBzC9Jgvc3WFw0RxDg',
        ]);

        $buku6 = Book::create([
            'category_id' => $katDiri->id,
            'title' => 'Atomic Habits',
            'slug' => Str::slug('Atomic Habits'),
            'author' => 'James Clear',
            'publisher' => 'Penguin Random House',
            'description' => 'Perubahan kecil yang memberikan hasil luar biasa.',
            'price' => 108000,
            'stock' => 150,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC0-pvSYjhK06ItvzTyrxsSb1ECN4gYaUx4Vu9H-gDS6f2A3U8sNOWwLiDUGt4TDBr9XNzVDzgkceRHLHLp592hxw8NLt2Wb6Vx8xDyuZmEt8wslqNk8h9fyGutjKuvy1P-nqiXQd9gqNkVzWORaBMUVSYClgos87owAwNGqSERJrfHdycUBCNwA3lpewpyFeN5oUe0XlZR7LqFFHp5_6e2PbDQFxcg5d5LzeknJn6L5y2z2eM4cduPAg',
        ]);

        $buku7 = Book::create([
            'category_id' => $katDiri->id,
            'title' => 'The Subtle Art of Not Giving a F*ck',
            'slug' => Str::slug('The Subtle Art of Not Giving a Fck'),
            'author' => 'Mark Manson',
            'publisher' => 'HarperOne',
            'description' => 'Sebuah pendekatan waras tentang cara menjalani hidup yang baik.',
            'price' => 110000,
            'stock' => 80,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuALj1VLgWl27qdX4hyy1qN-l227CoU0LvJ8ZTo5C9pI3cFkr58_3pywJjIYh14oCNBctxJs4lHFgJsQOfl1T4i-I7PBGnmf7ED7oVYbqZIGye3eUU5QeO75uWVH4zqo1Jvl1VFfYp7JC5ZwXLm6QDRT-8hoM5qMUTOSbbt_qutSmLhIw9sHiJy-ZGrlC0DDhspMQ6nS3u__KVjDwEh4XsfP0ANOjG1gtCywnB5WtA7zpI2soj0jmMzF2g',
        ]);

        $buku8 = Book::create([
            'category_id' => $katSastra->id,
            'title' => 'Gadis Kretek',
            'slug' => Str::slug('Gadis Kretek'),
            'author' => 'Ratih Kumala',
            'publisher' => 'Gramedia',
            'description' => 'Kisah cinta dan pencarian jati diri yang berlatar industri kretek Indonesia.',
            'price' => 95000,
            'stock' => 60,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBTgh9ydGZETZe0JtNafuzOdfMApW9Ye4lyebJMD8E4dknpgdqnkDHY0a7J-sb72HiAZoiW3sn4PGJVHe8f2ok7NbBHJPchtSj5pwYngkUSzUY2LoMZ5idbjEujcmPkyH4mFKtRMbakCt7WzlDWBW73Ox-SVLD-RSZycecrppPhyJ4oHYy7GQGe6RTgL9P41rYh5Xa95xrkI6uHuCSY98wVqKyHMom7CxgPJfN4mGoie-sV2JNnWnVKMg',
        ]);

        $buku9 = Book::create([
            'category_id' => $katSastra->id,
            'title' => 'Laskar Pelangi',
            'slug' => Str::slug('Laskar Pelangi'),
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'description' => 'Kisah inspiratif tentang persahabatan anak-anak Belitong.',
            'price' => 88000,
            'stock' => 45,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvPoTcG5fvO3Rp0Q916RvlTCHLDgsdmwJ8S-EtOjhfQy9UurmiTTxb6ttx8-nTwDcEsv5a3xpHxSAB43SpQzy0mlQAzSSqomR3fYd50OXwsyoIBZ6dlf4xHjIoclJK7Ys6eeNQYTAlGUQwnAboNa0rNfnk1NkQ3bWeBC0atDfn19ZlWhBTLq5VI_G6HGIsiSb8UyUawX_-1xTItwb13P6O3310fwgX2-U87Gc5PH1d8n1iBKHI_CdfJQ',
        ]);

        $buku10 = Book::create([
            'category_id' => $katTeknologi->id,
            'title' => 'The Pragmatic Programmer',
            'slug' => Str::slug('The Pragmatic Programmer'),
            'author' => 'Andrew Hunt',
            'publisher' => 'Addison-Wesley',
            'description' => 'Dari pemula menuju master software engineering.',
            'price' => 250000,
            'stock' => 20,
            'cover_image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBZgcCz-PYOPlq7HpSF9qqeUtUr0Sl1u8mnjGacbqTrdwcu6sWVeg-97m9tFlmFUu2lm8CzqRzkof6cGdzPfDzdWAte4hSgidKaTDz7-H1p4CFR29MDA54-vN-OL82M4pfDkzisSbBT5_rFHyxp1gBdhucfzF8heIU6U0woWiL8d09tjFM6JVltcP__JWmk6YTqGK56-0MnXU0byCCeJg-xYzxr_QKPxnkD9j9mGBzC9Jgvc3WFw0RxDg',
        ]);

        // 4. Buat Pesanan Dummy
        $order1 = Order::create([
            'user_id' => $customer->id,
            'order_number' => 'ORD-10001',
            'status' => 'menunggu',
            'total_amount' => 125000 + 138000,
            'shipping_name' => 'Danang Allam Ibrahim',
            'shipping_phone' => '081234567890',
            'shipping_address' => 'Jl. Kebon Jeruk Raya No. 27, Jakarta Barat',
            'payment_method' => 'cod',
        ]);

        OrderItem::create(['order_id' => $order1->id, 'book_id' => $buku1->id, 'quantity' => 1, 'price' => 125000]);
        OrderItem::create(['order_id' => $order1->id, 'book_id' => $buku3->id, 'quantity' => 1, 'price' => 138000]);

        $order2 = Order::create([
            'user_id' => $customer->id,
            'order_number' => 'ORD-10002',
            'status' => 'dikemas',
            'total_amount' => 98000,
            'shipping_name' => 'Budi Santoso',
            'shipping_phone' => '08987654321',
            'shipping_address' => 'Jl. Merdeka No. 1, Bandung',
            'payment_method' => 'transfer',
        ]);

        OrderItem::create(['order_id' => $order2->id, 'book_id' => $buku2->id, 'quantity' => 1, 'price' => 98000]);
    }
}
