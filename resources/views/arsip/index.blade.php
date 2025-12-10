@extends('layouts.app')

@section('title', 'Data Arsip')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Semua Arsip</h2>

    <!-- Tabel Daftar Arsip -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Arsip</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Arsip</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($arsips as $arsip)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $arsip->kode_arsip }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $arsip->judul }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $arsip->jenis_arsip ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $arsip->tanggal ? $arsip->tanggal->format('d M Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <!-- Tombol Download -->
                            @if ($arsip->file)
                                <a href="{{ route('arsip.download', $arsip->id) }}" class="text-green-600 hover:text-green-900">Download</a>
                            @endif
                            
                            <!-- Tombol Edit -->
                            <a href="{{ route('arsip.edit', $arsip->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            
                            <!-- Tombol Hapus (Form) -->
                            <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data arsip.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Link Paginasi -->
    <div class="mt-6">
        {{ $arsips->links() }}
    </div>
</div>
@endsection

