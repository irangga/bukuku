@extends('layouts.admin')
@php
    $activePage = 'pesan-masuk';
@endphp

@section('title', 'Pesan Masuk — Admin')

@section('content')
{{-- Header Halaman --}}
<div class="mb-space-lg">
    <h1 class="font-headline-md text-headline-md text-on-surface font-semibold mb-1">Pesan Masuk</h1>
    <p class="font-body-md text-body-md text-on-surface-variant">Kelola pesan dan pertanyaan dari pengunjung situs.</p>
</div>

{{-- Tabel Pesan --}}
<div class="bg-surface-container-lowest border border-surface-container-highest rounded-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left font-body-sm text-body-sm text-on-surface">
            <thead class="bg-surface-container-low font-label-md text-label-md text-on-surface-variant border-b border-surface-container-highest">
                <tr>
                    <th class="px-space-md py-space-sm font-semibold">Nama</th>
                    <th class="px-space-md py-space-sm font-semibold">Email</th>
                    <th class="px-space-md py-space-sm font-semibold">Subjek</th>
                    <th class="px-space-md py-space-sm font-semibold">Pesan</th>
                    <th class="px-space-md py-space-sm font-semibold">Tanggal</th>
                    <th class="px-space-md py-space-sm font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-highest">
                @forelse($messages as $message)
                <tr class="hover:bg-surface-container-lowest transition-colors">
                    <td class="p-space-md font-semibold">{{ $message->name }}</td>
                    <td class="p-space-md">{{ $message->email }}</td>
                    <td class="p-space-md">{{ $message->subject }}</td>
                    <td class="p-space-md max-w-xs truncate" title="{{ $message->message }}">{{ $message->message }}</td>
                    <td class="p-space-md text-on-surface-variant">{{ $message->created_at->translatedFormat('d M Y, H:i') }}</td>
                    <td class="p-space-md text-right">
                        <form action="{{ url('/admin/pesan-masuk/' . $message->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 border border-surface-container-highest text-error hover:bg-error/10 transition-colors rounded" title="Hapus Pesan">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-space-xl text-center text-on-surface-variant">
                        <span class="material-symbols-outlined text-[48px] mb-2 opacity-50">mail</span>
                        <p>Belum ada pesan masuk.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Paginasi --}}
@if($messages->hasPages())
<div class="mt-space-md">
    {{ $messages->links() }}
</div>
@endif

@endsection
