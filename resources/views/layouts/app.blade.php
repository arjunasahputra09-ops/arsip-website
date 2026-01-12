<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Arsip Digital')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js (dipakai di dashboard) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

<!-- ===================== TOPBAR ===================== -->
<nav class="bg-white shadow px-8 py-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('images/logo-fix.png') }}" alt="Logo Dinas" class="h-16 w-auto">
        <div class="flex flex-col leading-tight">
        <span class="text-lg font-semibold text-blue-700">
            Dinas Kearsipan Provinsi Sumatera Selatan
        </span>
        <span class="text-sm text-gray-600">
            Sistem Manajemen Arsip Digital
        </span>
    </div>
</div>

    <div class="flex items-center space-x-4">
        <span class="text-gray-700 text-sm">
            Selamat datang, <b>{{ Auth::user()->name ?? 'Admin' }}</b>
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                onclick="return confirm('Yakin ingin logout?')"
                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 text-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<!-- ===================== NAVBAR MENU ===================== -->
<div class="bg-white shadow-sm px-8">
    <ul class="flex space-x-8 text-sm font-medium text-gray-600">
        <li>
            <a href="{{ route('dashboard') }}"
               class="inline-block py-4 border-b-2
               {{ request()->routeIs('dashboard') ? 'border-blue-600 text-blue-600' : 'border-transparent hover:border-blue-600 hover:text-blue-600' }}">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('arsip.index') }}"
               class="inline-block py-4 border-b-2
               {{ request()->routeIs('arsip.index*') ? 'border-blue-600 text-blue-600' : 'border-transparent hover:border-blue-600 hover:text-blue-600' }}">
                Data Arsip
            </a>
        </li>

        <li>
            <a href="{{ route('arsip.create') }}"
               class="inline-block py-4 border-b-2
               {{ request()->routeIs('arsip.create') ? 'border-blue-600 text-blue-600' : 'border-transparent hover:border-blue-600 hover:text-blue-600' }}">
                Input Arsip
            </a>
        </li>

        <li>
            <a href="{{ route('arsip.search') }}"
               class="inline-block py-4 border-b-2
               {{ request()->routeIs('arsip.search') ? 'border-blue-600 text-blue-600' : 'border-transparent hover:border-blue-600 hover:text-blue-600' }}">
                Pencarian
            </a>
        </li>

        
    </ul>
</div>

<!-- ===================== CONTENT ===================== -->
<main class="p-6">
    @yield('content')
</main>

@stack('scripts')

</body>
</html>
