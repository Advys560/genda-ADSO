<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestor ADSO')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <nav aria-label="Navegación principal">
                <a class="nav-link" href="{{ route('aprendices.index') }}">Gestor ADSO · Aprendices</a>
            </nav>
        </header>

        @if (session('ok'))
            <div class="flash" role="status">{{ session('ok') }}</div>
        @endif

        @if ($errors->any())
            <div class="validation-errors" role="alert">
                <p>Revisa los siguientes campos:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>