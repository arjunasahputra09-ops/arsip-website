    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Login | Sistem Arsip Digital</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    </head>

    <body class="bg-gray-100 min-h-screen flex items-center justify-center">

        <div class="w-full max-w-4xl bg-white shadow-lg rounded overflow-hidden grid grid-cols-1 md:grid-cols-2">

            <!-- PANEL KIRI -->
            <div class="hidden md:flex relative flex-col justify-center px-10 text-white
            bg-cover bg-center" style="background-image: url('/images/kantor-arsip.jpg');" 
                class="absolute inset-0 bg-blue-900 opacity-60"></>
            <!-- OVERLAY GELAP -->
            <!-- KONTEN -->
            <div class="relative z-10">
                <h1 class="text-2xl font-bold mb-4">
                    Sistem Manajemen Arsip Digital
                </h1>

                <p class="text-sm leading-relaxed">
                    Sistem ini digunakan untuk pengelolaan statis
                    pada instansi pemerintah sesuai dengan kaidah kearsipan nasional.
                </p>

                <div class="mt-6 border-t border-blue-300 pt-4 text-sm">
                    Dinas Kearsipan Provinsi Sumatera Selatan
                </div>
            </div>
        </div>

        <!-- PANEL KANAN -->
        <div class="p-10">

            <div class="text-center mb-6">
                <img src="{{ asset('images/logo-fix.png') }}" alt="Logo Dinas Kearsipan" class="h-16 mx-auto mb-3">


                <h2 class="text-lg font-semibold text-gray-800">
                    Login Pengguna
                </h2>
                <p class="text-sm text-gray-600">
                    Masuk ke sistem arsip digital
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input type="email" name="email" required autofocus value="{{ old('email') }}" class="w-full mt-1 px-3 py-2 border rounded
                                focus:ring-2 focus:ring-blue-600 focus:outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input type="password" name="password" required class="w-full mt-1 px-3 py-2 border rounded
                                focus:ring-2 focus:ring-blue-600 focus:outline-none">
                </div>
                <!-- CAPTCHA -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Captcha
                    </label>

                    <div class="flex items-center justify-between mb-2">
                        <span class="font-mono text-lg tracking-widest text-blue-700 font-bold">
                            {{ session('captcha') }}
                        </span>

                        <a href="{{ route('login') }}"
                            class="text-sm text-orange-600 hover:underline flex items-center">
                            🔄 Reset
                        </a>
                    </div>

                    <input type="text" name="captcha" placeholder="Masukkan captcha" class="w-full px-3 py-2 border rounded
                    focus:ring-2 focus:ring-blue-600 focus:outline-none" required>
                </div>




                @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    {{ $errors->first() }}
                </div>
                @endif

                <button type="submit" class="w-full bg-gradient-to-r from-lime-500 via-green-500 to-emerald-500 text-black px-6 py-2 rounded-lg shadow-lg
                            hover:shadow-x1 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 transition-all duration-200 ">
                    Masuk
                </button>
            </form>

            <p class="text-xs text-center text-gray-500 mt-6">
                © {{ date('Y') }} Dinas Kearsipan Provinsi Sumatera Selatan
            </p>
        </div>

        </div>

    </body>

    </html>
