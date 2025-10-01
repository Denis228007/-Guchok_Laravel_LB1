<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Туристичний довідник')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="container mx-auto p-6 bg-gray-50 text-gray-800">
    <header class="mb-6">
        <h1 class="text-3xl font-bold text-blue-600"><a href="{{ route('home') }}">Туристичний Довідник</a></h1>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>
