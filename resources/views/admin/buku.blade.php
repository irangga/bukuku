@extends('layouts.admin')

@section('title', 'Manajemen Buku - Admin BUKUKU')

@section('content')
<div class="flex flex-col gap-space-lg">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="font-headline-md text-headline-md font-semibold text-on-surface">Manajemen Buku</h1>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola daftar buku yang tersedia di katalog</p>
        </div>
        <a href="{{ route('buku.create') }}" class="px-space-md py-space-sm bg-primary text-on-primary rounded-lg font-label-md text-label-md flex items-center gap-space-xs hover:bg-primary/90 transition-opacity">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Buku
        </a>
    </div>

    @if(session('success'))
    <div class="p-space-sm bg-green-100 text-green-800 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabel Buku --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low border-b border-surface-container-highest">
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold">Buku</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold">Kategori</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold text-right">Harga</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold text-center">Stok</th>
                        <th class="p-space-md font-label-md text-label-md text-on-surface font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-highest">
                    @forelse($books as $book)
                    <tr class="hover:bg-surface-container-lowest transition-colors">
                        <td class="p-space-md">
                            <div class="flex items-center gap-space-sm">
                                <div class="w-10 h-14 bg-surface-container-high rounded overflow-hidden shrink-0">
                                    @if($book->cover_image)
                                    <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                                    @else
                                    <div class="w-full h-full flex items-center justify-center text-on-surface-variant">
                                        <span class="material-symbols-outlined text-[16px]">menu_book</span>
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-label-lg text-label-lg font-semibold text-on-surface line-clamp-1">{{ $book->title }}</p>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant line-clamp-1">{{ $book->author }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-space-md">
                            <span class="px-space-xs py-0.5 rounded bg-surface-container-high font-label-sm text-label-sm text-on-surface-variant">
                                {{ $book->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="p-space-md text-right font-semibold text-on-surface">
                            Rp {{ number_format($book->price, 0, ',', '.') }}
                        </td>
                        <td class="p-space-md text-center">
                            @if($book->stock > 10)
                                <span class="px-space-xs py-0.5 rounded bg-green-100 text-green-800 font-label-sm text-label-sm font-semibold">{{ $book->stock }}</span>
                            @elseif($book->stock > 0)
                                <span class="px-space-xs py-0.5 rounded bg-yellow-100 text-yellow-800 font-label-sm text-label-sm font-semibold">{{ $book->stock }}</span>
                            @else
                                <span class="px-space-xs py-0.5 rounded bg-red-100 text-red-800 font-label-sm text-label-sm font-semibold">Habis</span>
                            @endif
                        </td>
                        <td class="p-space-md flex items-center justify-end gap-space-sm">
                            <a href="{{ route('buku.edit', $book->id) }}" class="w-8 h-8 rounded-lg bg-surface-container hover:bg-surface-container-high flex items-center justify-center text-on-surface transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('buku.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
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
                        <td colspan="5" class="p-space-xl text-center text-on-surface-variant">Belum ada data buku.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi --}}
        @if($books->hasPages())
        <div class="p-space-md border-t border-surface-container-highest bg-surface-container-lowest">
            {{ $books->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
