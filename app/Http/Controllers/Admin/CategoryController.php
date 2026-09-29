<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->paginate(10);
        $activePage = 'kategori';
        return view('admin.kategori', compact('categories', 'activePage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activePage = 'kategori';
        return view('admin.kategori-form', compact('activePage'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $kategori)
    {
        $category = $kategori;
        $activePage = 'kategori';
        return view('admin.kategori-form', compact('category', 'activePage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $kategori)
    {
        $kategori->update($request->validated());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $kategori)
    {
        if ($kategori->books()->count() > 0) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak bisa dihapus karena masih memiliki buku.');
        }
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
