<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Gestor ADSO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <nav>
                <a class="nav-link" href="/aprendices">Aprendices</a>
            </nav>
        </header>

        @if(session('ok'))
            <div class="flash">{{ session('ok') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>