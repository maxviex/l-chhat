<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Binnerlop - Chat App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Breeze + Tailwind + DaisyUI --}}
</head>
<body class="min-h-screen bg-base-100 text-base-content flex flex-col">

    <main class="flex-grow flex flex-col items-center justify-center px-6 text-center">
        <h1 class="text-5xl font-bold text-primary mb-4">Binnerlop</h1>
        <p class="max-w-xl text-gray-600 dark:text-gray-300 mb-8">
            Aplikasi chat modern, aman, dan ringan. Mulai ngobrol dengan teman, keluarga, atau tim kamu sekarang.
        </p>
        <div class="flex gap-4 flex-wrap justify-center">
            <a href="{{ route('login') }}" class="btn btn-primary px-8 py-3 text-lg">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline px-8 py-3 text-lg">Register</a>
        </div>
    </main>

    <footer class="py-4 text-center text-sm text-gray-400 dark:text-gray-500">
        &copy; {{ now()->year }} Binnerlop. All rights reserved.
    </footer>

</body>
</html>
