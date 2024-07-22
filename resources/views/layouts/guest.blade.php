<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/455e570e4a.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-base-300">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-base-200 shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex items-center justify-center space-x-4 mb-6 bg-base-300 p-4 rounded-md">
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="w-12 h-12">
                <h3 class="text-2xl font-bold">GYMBRO</h3>
            </div>
            <p class="text-center mb-6">Welcome to Gymbro!</p>
            {{ $slot }}
        </div>
    </div>
</body>

</html>