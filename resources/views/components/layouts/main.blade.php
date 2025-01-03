<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{ seo()->generate() }}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="/assets/images/logo.png" sizes="48x48" />
    {{-- <link rel="icon" type="image/svg+xml" href="/favicon.svg" /> --}}
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/logo.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preload" href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" as="style"
        onload="this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet">
    </noscript>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    </script>

    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css" as="style"
        onload="this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tippy.js/6.3.7/tippy.min.css">
    </noscript>

    <!-- Used to add dark mode right away, adding here prevents any flicker -->
    <script>
        if (typeof(Storage) !== "undefined") {
            if (localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true') {
                document.documentElement.classList.add('dark');
            }
        }
    </script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
    @if ((env('APP_ENV') != 'local' && !auth()->check()) || (auth()->check() && !auth()->user()->isAdmin()))
        <script async defer data-domain="bskybanner.com" src="https://analytics.elerion.com/js/plausible.js"></script>
    @endif
</head>

<body class="min-h-screen antialiased bg-white dark:bg-gradient-to-b dark:from-gray-950 dark:to-gray-900 ">
    {{ $slot }}
    @if (auth()->user()?->isAdmin())
        {{-- <x-pan-analytics::viewer /> --}}
    @endif
    @fluxScripts
    {{-- <x-ui.app.footer />
    <x-ui.app.plausible /> --}}
</body>

</html>
