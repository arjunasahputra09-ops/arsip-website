@extends('layouts.app')

@section('title', 'Backup Data')

@section('content')
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Kolom Aksi Backup -->
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Buat Backup Baru</h2>

        <!-- Form Backup Database -->
        <form action="{{ route('backup.database') }}" method="POST" class="mb-6 pb-6 border-b">
            @csrf
            <h3 class="text-lg font-semibold text-gray-700 mb-2">1. Backup Database (.sql)</h3>
            <p class="text-sm text-gray-600 mb-3">Ini akan men-download semua data teks (arsip, user, dll) dari database Anda.</p>
            
            <label for="mysqldump_path" class="block text-sm font-medium text-gray-700 mb-1">Path ke `mysqldump.exe`</label>
            <input type="text" id="mysqldump_path" name="mysqldump_path" class="w-full rounded-lg shadow-sm border-gray-300" value="{{ old('mysqldump_path', 'C:\xampp\mysql\bin\mysqldump.exe') }}" required>
            <small class="text-gray-500">Contoh: `C:\xampp\mysql\bin\mysqldump.exe`</Osmall>
            @error('mysqldump_path')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            
            <button type="submit" class="mt-3 w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                Buat Backup Database
            </button>
        </form>

        <!-- Form Backup Files -->
        <form action="{{ route('backup.files') }}" method="POST">
            @csrf
            <h3 class="text-lg font-semibold text-gray-700 mb-2">2. Backup Files (.zip)</h3>
            <p class="text-sm text-gray-600 mb-3">Ini akan meng-kompres semua file yang di-upload (PDF, DOCX, JPG, dll) ke dalam satu file `.zip`.</p>
            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700">
                Buat Backup Files
            </button>
        </form>
    </div>

    <!-- Kolom Daftar Backup -->
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar File Backup</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama File</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($backupFiles as $file)
                        <tr>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <p class="text-sm font-medium text-gray-900">{{ $file['name'] }}</p>
                                <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($file['created_at'])->format('d M Y, H:i') }} | {{ number_format($file['size'] / 1024 / 1024, 2) }} MB</p>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if ($file['type'] == 'Files')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Files (.zip)
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Database (.sql)
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('backup.download', $file['name']) }}" class="text-indigo-600 hover:text-indigo-900">Download</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                Belum ada file backup.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
