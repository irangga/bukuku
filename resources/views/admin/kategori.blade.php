@extends('layouts.admin')

@section('title', 'Manajemen Kategori - Admin BUKUKU')

@section('content')
<div class="flex flex-col gap-space-lg">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-headline-md text-headline-md font-semibold text-on-surface">Manajemen Kategori</h1>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola daftar kategori buku</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="px-space-md py-space-sm bg-primary text-on-primary rounded-lg font-label-md text-label-md flex items-center gap-space-xs hover:bg-primary/90 transition-opacity">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Kategori
        </a>
    </div>

    @if(session('success'))
    <div class="p-space-sm bg-green-100 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="p-space-sm bg-red-100 text-red-800 rounded-lg">
        {{ session('error') }}
    </div>
    @endif

    {{-- Tabel Kategori --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low border-b border-surface-container-highest">
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold">Nama Kategori</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold">Slug</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold text-center">Jumlah Buku</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-highest">
                    @forelse($categories as $category)
                    <tr class="hover:bg-surface-container-lowest transition-colors">
                        <td class="p-space-md">
                            <span class="font-label-lg text-label-lg font-semibold text-on-surface">{{ $category->name }}</span>
                        </td>
                        <td class="p-space-md text-on-surface-variant font-mono text-sm">
                            {{ $category->slug }}
                        </td>
                        <td class="p-space-md text-center text-on-surface font-semibold">
                            {{ $category->books_count }}
                        </td>
                        <td class="p-space-md flex items-center justify-end gap-space-sm">
                            <a href="{{ route('kategori.edit', $category->id) }}" class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-error/10 hover:bg-error/20 flex items-center justify-center text-error transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-space-xl text-center text-on-surface-variant">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi --}}
        @if($categories->hasPages())
        <div class="p-space-md border-t border-surface-container-highest bg-surface-container-lowest">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
