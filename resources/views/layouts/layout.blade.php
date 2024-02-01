<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>@yield('title')</title>
</head>

<body class="dark:bg-gray-800 dark:text-gray-300">
    <header>
        @include('layouts.navigation')
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
