<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Judul Default')</title>

    <!-- Tailwind + DaisyUI CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.51.5/dist/full.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles
</head>
<body class="min-h-screen flex flex-col">

    <!-- Navbar -->
    @include('layouts.master.navbar')

    <!-- Main content -->
    <main class="flex-grow container mx-auto px-0 py-0">
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('layouts.master.footer')

    @livewireScripts
    @stack('scripts')

    <script>
        // Dark mode toggle handler
        const toggle = document.getElementById('dark-toggle');
        const htmlTag = document.documentElement;

        // Cek localStorage kalau ada preferensi
        if (localStorage.getItem('theme') === 'dark') {
            htmlTag.setAttribute('data-theme', 'dark');
            toggle.checked = true;
        }

        toggle.addEventListener('change', function() {
            if (this.checked) {
                htmlTag.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                htmlTag.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>
