<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/main-icon.png') }}" type="image/png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cyan-100 text-gray-800 min-h-screen flex flex-col">
    <x-navbar />
    <!-- Main Content -->   
    <main class="flex-grow flex items-center justify-center container mx-auto py-6 px-6">
        @yield('content')
    </main>
    <x-footer />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
