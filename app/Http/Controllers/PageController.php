<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ContactRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Message;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $categories = Category::all();
        $query = Book::with('category');
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }
        
        $books = $query->take(12)->get();
        return view('beranda', compact('books', 'categories'));
    }

    /**
     * Menampilkan katalog seluruh buku dengan paginasi.
     *
     * @return \Illuminate\View\View
     */
    public function catalog(Request $request)
    {
        $categories = Category::all();
        $query = Book::with('category');
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }
        
        $books = $query->paginate(12)->withQueryString();
        return view('katalog', compact('books', 'categories'));
    }

    /**
     * Menampilkan halaman detail untuk sebuah buku.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function bookDetail($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('detail-buku', compact('book'));
    }

    /**
     * Menampilkan halaman tentang kami.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('tentang-kami');
    }

    /**
     * Menampilkan formulir kontak.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('kontak');
    }

    /**
     * Menangani pengiriman pesan dari formulir kontak.
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitContact(ContactRequest $request)
    {
        Message::create($request->validated());
        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}
