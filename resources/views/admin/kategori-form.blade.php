@extends('layouts.admin')

@section('title', isset($category) ? 'Edit Kategori' : 'Tambah Kategori')

@section('content')
<div class="flex flex-col gap-space-lg max-w-3xl">
    {{-- Header Halaman --}}
    <div class="flex items-center gap-space-sm">
        <a href="{{ route('kategori.index') }}" class="w-10 h-10 rounded-full hover:bg-surface-container flex items-center justify-center text-on-surface-variant transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="font-headline-md text-headline-md font-semibold text-on-surface">
                {{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
            </h1>
        </div>
    </div>

    {{-- Form --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest p-space-lg">
        <form action="{{ isset($category) ? route('kategori.update', $category->id) : route('kategori.store') }}" method="POST" class="flex flex-col gap-space-md">
            @csrf
            @if(isset($category))
                @method('PUT')
            @endif

            {{-- Nama --}}
            <div>
                <label for="name" class="block font-label-md text-label-md text-on-surface mb-1.5">Nama Kategori <span class="text-error">*</span></label>
                <input type="text" id="name" name="name" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('name') border border-error @enderror" value="{{ old('name', $category->name ?? '') }}" required>
                @error('name')
                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block font-label-md text-label-md text-on-surface mb-1.5">Slug (URL) <span class="text-error">*</span></label>
                <input type="text" id="slug" name="slug" class="w-full h-10 px-3.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow @error('slug') border border-error @enderror" value="{{ old('slug', $category->slug ?? '') }}" required>
                @error('slug')
                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block font-label-md text-label-md text-on-surface mb-1.5">Deskripsi</label>
                <textarea id="description" name="description" rows="4" class="w-full px-3.5 py-2.5 bg-surface-container-low text-on-surface font-body-sm text-body-sm rounded-lg outline-none focus:ring-2 focus:ring-primary/50 transition-shadow resize-none">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description')
                <p class="mt-1 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-space-sm mt-space-sm pt-space-md border-t border-surface-container-highest">
                <a href="{{ route('kategori.index') }}" class="px-space-md py-space-sm rounded-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-space-md py-space-sm bg-primary text-on-primary rounded-lg font-label-md text-label-md hover:bg-primary/90 transition-opacity">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        if (!'{{ isset($category) }}') {
            const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
            slugInput.value = slug;
        }
    });
</script>
@endsection
