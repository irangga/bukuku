{{--
|--------------------------------------------------------------------------
| Daftar Pelanggan (Admin)
|--------------------------------------------------------------------------
| Menampilkan data pengguna/pelanggan yang terdaftar di BUKUKU.
|--------------------------------------------------------------------------
--}}
@extends('layouts.admin')

@section('title', 'Data Pelanggan — BUKUKU Admin')

@php
    $activePage = 'data-pelanggan';
@endphp

@section('content')
<div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md mb-space-xl">
    <div>
        <h1 class="font-headline-lg text-headline-lg font-bold text-on-surface mb-space-xs">Data Pelanggan</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Daftar pengguna yang terdaftar di aplikasi BUKUKU.</p>
    </div>
    <div class="flex items-center gap-space-sm">
        <div class="relative w-64">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
            <input type="text" placeholder="Cari Nama / Email..." class="w-full h-10 pl-10 pr-4 rounded-lg border border-surface-container-highest bg-surface-container-lowest text-body-sm focus:border-primary outline-none transition-colors">
        </div>
    </div>
</div>

<div class="bg-surface-container-lowest rounded-xl shadow-sm border border-surface-container-highest overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-space-md font-semibold">Nama Lengkap</th>
                    <th class="p-space-md font-semibold">Kontak (Email)</th>
                    <th class="p-space-md font-semibold">Tanggal Daftar</th>
                    <th class="p-space-md font-semibold">Total Pesanan</th>
                    <th class="p-space-md font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-highest font-body-sm text-body-sm text-on-surface">
                @forelse($users as $user)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="p-space-md">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center font-semibold text-on-surface-variant shrink-0">{{ substr($user->name, 0, 2) }}</div>
                            <span class="font-semibold text-on-surface">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="p-space-md">
                        <div class="flex flex-col">
                            <span class="text-on-surface">{{ $user->email }}</span>
                        </div>
                    </td>
                    <td class="p-space-md text-on-surface-variant">{{ $user->created_at->translatedFormat('d M Y') }}</td>
                    <td class="p-space-md font-semibold">{{ $user->orders()->count() }} Pesanan</td>
                    <td class="p-space-md text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ url('/admin/pengguna/' . $user->id) }}" class="p-1.5 border border-surface-container-highest text-primary hover:bg-primary/10 transition-colors rounded" title="Lihat Detail">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </a>
                            <form action="{{ url('/admin/pengguna/' . $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelanggan ini beserta semua data pesanannya?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 border border-surface-container-highest text-error hover:bg-error/10 transition-colors rounded" title="Hapus Pelanggan">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-space-lg text-center text-on-surface-variant">Belum ada pelanggan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-space-md border-t border-surface-container-highest">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
