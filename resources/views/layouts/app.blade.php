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
            <div class="d-flex align-items-center">

                <a href="{{ route('cart.index') }}" class="text-dark me-3 position-relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    @if(Cart::getContent()->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ Cart::getContent()->count() }}
                        </span>
                    @endif
                </a>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    + Додати місце
                </a>
            </div>
        </div>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="py-3 my-4 border-top">
        <p class="text-center text-muted">&copy; {{ now()->year }} Туристичний Довідник</p>
    </footer>
</body>
</html>
