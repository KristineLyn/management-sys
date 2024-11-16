<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white border-b border-gray-200">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="/" class="text-lg font-semibold text-gray-700">My Website</a>
            <div x-data="{ open: false }" class="relative">
                @auth
                    <!-- Authenticated User Profile Image -->
                    <img 
                        src="{{ Auth::user()->profile_image ?? 'https://via.placeholder.com/40' }}" 
                        alt="Profile" 
                        class="w-10 h-10 rounded-full cursor-pointer" 
                        @click="open = !open"
                    />
                    <div 
                        x-show="open" 
                        @click.away="open = false" 
                        class="absolute right-0 mt-2 bg-white shadow-lg rounded-md w-40"
                    >
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                @else
                    <!-- Login and Register Buttons -->
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 px-4 py-2">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container mx-auto py-6">
        @yield('content')
    </main>
</body>
</html>