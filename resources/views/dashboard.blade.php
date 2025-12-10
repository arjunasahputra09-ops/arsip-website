<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Arsip Digital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-blue-700">Dinas Kearsipan Provinsi Sumatera Selatan</h1>
            <p class="text-gray-600 text-sm">Sistem Manajemen Arsip Digital</p>
        </div>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700">Selamat datang, <b>Admin</b></span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 flex items-center">
                    <span class="mr-1">🔓</span> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Tabs menu -->
    <div class="bg-white shadow mt-2 px-6 py-3 flex space-x-6">
        <a href="#" class="text-blue-600 font-medium flex items-center">🏠 Dashboard</a>
        <a href="{{ route('arsip.create') }}" class="text-gray-600 hover:text-blue-600 flex items-center">➕ Input Arsip</a>
        <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">🔍 Pencarian</a>
        <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">📂 Data Arsip</a>
        <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">💾 Backup</a>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6">
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow text-center">
            <h2 class="text-2xl font-bold">3</h2>
            <p>Total Arsip</p>
        </div>
        <div class="bg-green-600 text-white p-6 rounded-lg shadow text-center">
            <h2 class="text-2xl font-bold">3</h2>
            <p>Arsip Digital</p>
        </div>
        <div class="bg-purple-600 text-white p-6 rounded-lg shadow text-center">
            <h2 class="text-2xl font-bold">1</h2>
            <p>Arsip Fisik</p>
        </div>
        <div class="bg-orange-500 text-white p-6 rounded-lg shadow text-center">
            <h2 class="text-2xl font-bold">0</h2>
            <p>Tahun Ini</p>
        </div>
    </div>

    <!-- Grafik Distribusi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-4">Distribusi Jenis Arsip</h3>
            <canvas id="jenisArsipChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold mb-4">Distribusi Media Arsip</h3>
            <canvas id="mediaArsipChart"></canvas>
        </div>
    </div>

    <!-- Statistik Arsip per Tahun -->
    <div class="p-6">
        <h3 class="font-semibold mb-4">Statistik Arsip per Tahun</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-indigo-100 text-center p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold text-indigo-700">2</h2>
                <p>Tahun 2024</p>
            </div>
            <div class="bg-indigo-100 text-center p-6 rounded-lg shadow">
                <h2 class="text-2xl font-bold text-indigo-700">1</h2>
                <p>Tahun 2023</p>
            </div>
        </div>
    </div>

    u53hetm sy83i9g
    

    <!-- Script Chart.js -->
    <script>
        const jenisCtx = document.getElementById('jenisArsipChart');
        new Chart(jenisCtx, {
            type: 'bar',
            data: {
                labels: ['Dokumen Legal', 'Laporan', 'Foto/Video'],
                datasets: [{
                    label: 'Jumlah',
                    data: [1, 1, 1],
                    backgroundColor: ['#ef4444', '#f59e0b', '#8b5cf6']
                }]
            },
            options: { responsive: true }
        });

        const mediaCtx = document.getElementById('mediaArsipChart');
        new Chart(mediaCtx, {
            type: 'bar',
            data: {
                labels: ['Digital'],
                datasets: [{
                    label: 'Jumlah',
                    data: [2, 1],
                    backgroundColor: ['#10b981', '#8b5cf6']
                }]
            },
            options: { responsive: true }
        });
    </script>

</body>
</html>
