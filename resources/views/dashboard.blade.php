<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistem Arsip Digital</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

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
               class="inline-block py-4 border-b-2 border-blue-600 text-blue-600">
                Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('arsip.index') }}"
               class="inline-block py-4 border-b-2 border-transparent hover:border-blue-600 hover:text-blue-600">
                Data Arsip
            </a>
        </li>

        <li>
            <a href="{{ route('arsip.create') }}"
               class="inline-block py-4 border-b-2 border-transparent hover:border-blue-600 hover:text-blue-600">
                Input Arsip
            </a>
        </li>

        <li>
            <a href="{{ route('arsip.search') }}"
               class="inline-block py-4 border-b-2 border-transparent hover:border-blue-600 hover:text-blue-600">
                Pencarian
            </a>
        </li>

    </ul>
</div>

<!-- ===================== BREADCRUMB ===================== -->
<div class="px-8 py-4 text-sm text-gray-500">
    Home / Dashboard
</div>

<!-- ===================== INFO CARDS ===================== -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-8">

    <div class="bg-gradient-to-r from-green-500 to-green-400 text-white p-6 rounded-lg shadow flex justify-between">
        <div>
            <p class="text-sm">Arsip Tersedia</p>
            <h2 class="text-3xl font-bold">238</h2>
        </div>
        <div class="text-4xl opacity-80">📁</div>
    </div>

    <div class="bg-gradient-to-r from-cyan-500 to-cyan-400 text-white p-6 rounded-lg shadow flex justify-between">
        <div>
            <p class="text-sm">Arsip Masuk</p>
            <h2 class="text-3xl font-bold">283</h2>
        </div>
        <div class="text-4xl opacity-80">⬇️</div>
    </div>

    <div class="bg-gradient-to-r from-red-500 to-red-400 text-white p-6 rounded-lg shadow flex justify-between">
        <div>
            <p class="text-sm">Arsip Keluar</p>
            <h2 class="text-3xl font-bold">45</h2>
        </div>
        <div class="text-4xl opacity-80">⬆️</div>
    </div>

</div>

<!-- ===================== MAIN CONTENT ===================== -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-8 py-6">

    <!-- ===== TABLE ARSIP ===== -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-700 mb-4">
            Daftar Arsip Terbaru
        </h3>

        <table class="w-full text-sm border">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="border px-3 py-2 text-left">No</th>
                    <th class="border px-3 py-2 text-left">Kode Arsip</th>
                    <th class="border px-3 py-2 text-left">Judul Arsip</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">1</td>
                    <td class="border px-3 py-2">ARS-001</td>
                    <td class="border px-3 py-2">Surat Keputusan</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">2</td>
                    <td class="border px-3 py-2">ARS-002</td>
                    <td class="border px-3 py-2">Laporan Tahunan</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2">3</td>
                    <td class="border px-3 py-2">ARS-003</td>
                    <td class="border px-3 py-2">Dokumentasi Kegiatan</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- ===== CHART ===== -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-700 mb-4">
            Statistik Arsip Masuk / Keluar Tahun 2025
        </h3>

        <canvas id="arsipChart"></canvas>
    </div>

</div>

<!-- ===================== CHART SCRIPT ===================== -->
<script>
    const ctx = document.getElementById('arsipChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [
                {
                    label: 'Arsip Masuk',
                    data: [220, 60, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: '#22d3ee'
                },
                {
                    label: 'Arsip Keluar',
                    data: [45, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: '#ef4444'
                }
            ]
        },
        options: {
            responsive: true
        }
    });
</script>

</body>
</html>
