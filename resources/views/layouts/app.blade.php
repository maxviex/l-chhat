<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-base-100 text-base-content font-sans antialiased">

    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <livewire:layout.navigation />

        <!-- Header -->
        @if (isset($header))
            <div class="bg-base-200 shadow-sm mb-4">
                <div class="max-w-7xl mx-auto py-4 px-6">
                    <h1 class="text-2xl font-bold text-base-content">{{ $header }}</h1>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer (optional) -->
        <footer class="footer footer-center p-4 bg-base-200 text-base-content mt-6">
            <aside>
                <p>© {{ date('Y') }} - Built with 💻 & ☕ </p>
            </aside>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
