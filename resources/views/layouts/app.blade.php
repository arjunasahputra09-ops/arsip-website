<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Arsip Digital') - Dinas Kearsipan</title>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    
    <!-- Link Chart.js (hanya untuk dashboard) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-blue-700">Dinas Kearsipan Provinsi Sumatera Selatan</h1>
            <p class="text-gray-600 text-sm">Sistem Manajemen Arsip Digital</p>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700">Selamat datang, <b>{{ Auth::user()->name ?? 'Admin' }}</b></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Tabs menu -->
    <div class="bg-white shadow-sm -mt-px px-6 py-3 flex space-x-6 border-t border-gray-200">
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600 flex items-center {{ request()->routeIs('dashboard') ? 'text-blue-600 font-medium' : '' }}">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>
        <a href="{{ route('arsip.create') }}" class="text-gray-600 hover:text-blue-600 flex items-center {{ request()->routeIs('arsip.create') ? 'text-blue-600 font-medium' : '' }}">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Input Arsip
        </a>
        
        <a href="{{ route('arsip.search') }}" class="text-gray-600 hover:text-blue-600 flex items-center {{ request()->routeIs('arsip.search') ? 'text-blue-600 font-medium' : '' }}">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            Pencarian
        </a>
        
        <a href="{{ route('arsip.index') }}" class="text-gray-600 hover:text-blue-600 flex items-center {{ request()->routeIs('arsip.index*') || request()->routeIs('arsip.edit') ? 'text-blue-600 font-medium' : '' }}">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
            Data Arsip
        </a>
        
        <!-- INI PERBAIKANNYA -->
        <a href="{{ route('backup.index') }}" class="text-gray-600 hover:text-blue-600 flex items-center {{ request()->routeIs('backup.index') ? 'text-blue-600 font-medium' : '' }}">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Backup
        </a>
    </div>

    <!-- Konten Halaman Akan Muncul Di Sini -->
    <main class="p-6">
        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="max-w-7xl mx-auto bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <!-- Notifikasi Error -->
        @if (session('error'))
            <div class="max-w-7xl mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Script khusus untuk halaman tertentu -->
    @stack('scripts')
</body>
</html>

