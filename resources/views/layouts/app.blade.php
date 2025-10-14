<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Туристичний довідник')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <header class="py-3 mb-4 border-bottom bg-white shadow-sm">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="fs-4 fw-bold text-dark text-decoration-none">
                Туристичний Довідник
            </a>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                + Додати місце
            </a>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="py-3 my-4 border-top">
        <p class="text-center text-muted">&copy; {{ now()->year }} Туристичний Довідник</p>
    </footer>
</body>
</html>
