@extends('layouts.app')

@section('title', 'Pencarian Arsip')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pencarian Arsip</h2>

    <!-- Form Pencarian -->
    <form action="{{ route('arsip.search') }}" method="GET" class="mb-6">
        <div class="flex">
            <input type="text" name="q" class="w-full rounded-l-lg shadow-sm"
                placeholder="Cari berdasarkan Judul, Kode, atau Deskripsi..." value="{{ request('q') }}">
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-r-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Cari
            </button>
        </div>
    </form>

    <!-- Tabel Hasil Pencarian -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                        Arsip</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                        Arsip</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

                @forelse ($arsips as $arsip)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $arsip->kode_arsip }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $arsip->judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $arsip->jenis_arsip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $arsip->tanggal->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        @if ($arsip->file)
                        <a href="{{ route('arsip.download', $arsip->id) }}"
                            class="text-blue-600 hover:text-blue-900">Download</a>
                        @else
                        <span class="text-gray-400">Fisik</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        @if (request('q'))
                        Arsip tidak ditemukan untuk pencarian: "{{ request('q') }}"
                        @else
                        Silakan masukkan kata kunci untuk memulai pencarian.
                        @endif
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- Paginasi (jika hasil pencarian banyak) -->
    <div class="mt-6">
        {{ $arsips->withQueryString()->links() }}
    </div>

</div>
@endsection
