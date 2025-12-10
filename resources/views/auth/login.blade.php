<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Arsip Statis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Login </h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full px-4 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Login</button>
        </form>
    </div>
</body>
</html>