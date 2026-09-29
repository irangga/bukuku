@extends('layouts.admin')

@section('title', isset($book) ? 'Edit Buku' : 'Tambah Buku')

@section('content')
<div class="flex flex-col gap-space-lg max-w-4xl">
    {{-- Header Halaman --}}
    <div class="flex items-center gap-space-sm">
        <a href="{{ route('buku.index') }}" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center text-on-surface-variant transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="font-headline-md text-headline-md font-semibold text-on-surface">
                {{ isset($book) ? 'Edit Data Buku' : 'Tambah Buku Baru' }}
            </h1>
        </div>
    </div>

    {{-- Form --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest p-space-lg">
        <form action="{{ isset($book) ? route('buku.update', $book->id) : route('buku.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-space-md">
            @csrf
            @if(isset($book))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-space-md">
                {{-- Judul --}}
                <div>
                    <label for="title" class="block font-label-md text-label-md text-on-surface mb-1.5">Judul Buku <span class="text-error">*</span></label>
                    <input type="text" id="title" name="title" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('title') border border-error @enderror" value="{{ old('title', $book->title ?? '') }}" required>
                    @error('title')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label for="slug" class="block font-label-md text-label-md text-on-surface mb-1.5">Slug (URL) <span class="text-error">*</span></label>
                    <input type="text" id="slug" name="slug" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('slug') border border-error @enderror" value="{{ old('slug', $book->slug ?? '') }}" required>
                    @error('slug')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penulis --}}
                <div>
                    <label for="author" class="block font-label-md text-label-md text-on-surface mb-1.5">Penulis <span class="text-error">*</span></label>
                    <input type="text" id="author" name="author" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('author') border border-error @enderror" value="{{ old('author', $book->author ?? '') }}" required>
                    @error('author')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category_id" class="block font-label-md text-label-md text-on-surface mb-1.5">Kategori <span class="text-error">*</span></label>
                    <select id="category_id" name="category_id" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('category_id') border border-error @enderror" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Penerbit --}}
                <div>
                    <label for="publisher" class="block font-label-md text-label-md text-on-surface mb-1.5">Penerbit</label>
                    <input type="text" id="publisher" name="publisher" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('publisher') border border-error @enderror" value="{{ old('publisher', $book->publisher ?? '') }}">
                    @error('publisher')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ISBN --}}
                <div>
                    <label for="isbn" class="block font-label-md text-label-md text-on-surface mb-1.5">ISBN</label>
                    <input type="text" id="isbn" name="isbn" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('isbn') border border-error @enderror" value="{{ old('isbn', $book->isbn ?? '') }}">
                    @error('isbn')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div>
                    <label for="price" class="block font-label-md text-label-md text-on-surface mb-1.5">Harga (Rp) <span class="text-error">*</span></label>
                    <input type="number" id="price" name="price" min="0" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('price') border border-error @enderror" value="{{ old('price', $book->price ?? '') }}" required>
                    @error('price')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stock" class="block font-label-md text-label-md text-on-surface mb-1.5">Stok Fisik <span class="text-error">*</span></label>
                    <input type="number" id="stock" name="stock" min="0" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('stock') border border-error @enderror" value="{{ old('stock', $book->stock ?? '') }}" required>
                    @error('stock')
                    <p class="mt-1 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block font-label-md text-label-md text-on-surface mb-1.5">Sinopsis / Deskripsi</label>
                <textarea id="description" name="description" rows="5" class="w-full px-3.5 py-2.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow resize-none">{{ old('description', $book->description ?? '') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cover Image --}}
            <div>
                <label for="cover_image" class="block font-label-md text-label-md text-on-surface mb-1.5">Cover Image (URL atau Upload file) </label>
                <input type="text" id="cover_image_url" name="cover_image" class="w-full h-10 px-3.5 mb-2 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow" value="{{ old('cover_image', (!isset($book) || str_starts_with($book->cover_image, '/storage/')) ? '' : $book->cover_image) }}" placeholder="Atau masukkan URL gambar">
                <input type="file" id="cover_image" name="cover_image" accept="image/*" class="w-full text-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-on-primary hover:file:bg-primary/90">
                @if(isset($book) && $book->cover_image)
                    <div class="mt-2 w-24 h-32 bg-surface-container-high rounded overflow-hidden">
                        <img src="{{ $book->cover_image }}" alt="Current Cover" class="w-full h-full object-cover">
                    </div>
                @endif
                @error('cover_image')
                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-space-sm mt-space-sm pt-space-md border-t border-surface-container-highest">
                <a href="{{ route('buku.index') }}" class="px-space-md py-space-sm rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container transition-colors">
                    Batal
                </a>
                @if(isset($book))
                <button type="submit" class="px-space-md py-space-sm bg-primary text-on-primary rounded-lg font-label-md text-label-md hover:bg-primary/90 transition-opacity">
                    Update Buku
                </button>
                @else
                <button type="submit" class="px-space-md py-space-sm bg-primary text-on-primary rounded-lg font-label-md text-label-md hover:bg-primary/90 transition-opacity">
                    Simpan Buku
                </button>
                @endif
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', function() {
        if (!'{{ isset($book) }}') {
            const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            slugInput.value = slug;
        }
    });
</script>
@endsection
