<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->paginate(10);
        $activePage = 'koleksi-buku';
        return view('admin.buku', compact('books', 'activePage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $activePage = 'koleksi-buku';
        return view('admin.buku-form', compact('categories', 'activePage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $data['cover_image'] = $request->cover_image_url;
        }

        Book::create($data);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $buku)
    {
        $book = $buku;
        $categories = Category::all();
        $activePage = 'koleksi-buku';
        return view('admin.buku-form', compact('book', 'categories', 'activePage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $buku)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $data['cover_image'] = $request->cover_image_url;
        }

        $buku->update($data);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
