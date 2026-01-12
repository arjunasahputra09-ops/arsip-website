@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Input Arsip Baru</h2>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="mb-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Form Input Arsip -->
        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kode Arsip -->
            <div class="mb-4">
                <label for="kode_arsip" class="block text-sm font-medium text-gray-700 mb-1">Kode Arsip</label>
                <input type="text" id="kode_arsip" name="kode_arsip" class="w-full border-blue-500 rounded-lg shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-300" value="{{ old('kode_arsip') }}" required>
                @error('kode_arsip')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Judul Arsip -->
            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Arsip</label>
                <input type="text" id="judul" name="judul" class="w-full border-gray-300 rounded-lg shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-300" value="{{ old('judul') }}" required>
                @error('judul')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-300">{{ old('deskripsi') }}</textarea>
            </div>
            
            <!-- ====================================== -->
            <!--   INI ADALAH DROPDOWN YANG BARU       -->
            <!-- ====================================== -->
            <div class="mb-4">
                <label for="jenis_arsip" class="block text-sm font-medium text-gray-700 mb-1">Jenis Arsip</label>
                <select id="jenis_arsip" name="jenis_arsip" class="w-full border-gray-300 rounded-lg shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-300" required>
                    <option value="">-- Pilih Jenis Arsip --</option>
                    <option value="Dokumen Legal" {{ old('jenis_arsip') == 'Dokumen Legal' ? 'selected' : '' }}>Dokumen Legal</option>
                    <option value="Laporan" {{ old('jenis_arsip') == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                    <option value="Foto/Video" {{ old('jenis_arsip') == 'Foto/Video' ? 'selected' : '' }}>Foto/Video</option>
                    <option value="Lainnya" {{ old('jenis_arsip') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_arsip')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="mb-4">
                <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Arsip</label>
                <input type="date" id="tanggal" name="tanggal" class="w-full border-gray-300 rounded-lg shadow-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-300" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Upload File -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Upload File (Opsional)</label>
                <input type="file" id="file" name="file" class="w-full border-gray-300 rounded-lg p-2 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:ring-2 focus:ring-blue-500 hover:ring-2 hover:ring-blue-300">
                <small class="text-gray-500">Format: PDF, DOC, DOCX, JPG, PNG (max 2MB)</small>
                @error('file')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Simpan Arsip
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

