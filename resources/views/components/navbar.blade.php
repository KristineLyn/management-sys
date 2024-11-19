<!-- Navigation Bar -->
<nav class="bg-cyan-100">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <!-- Logo -->
        <a href="/" class="flex items-center">
            <img src="{{ asset('images/main-logo.png') }}" alt="Main Logo" class="h-10">
        </a>
        <!-- Auth Navigation -->
        <div x-data="{ open: false }" class="relative">
            @auth
                <img 
                    src="{{ Auth::user()->profile_image ?? asset('images/def-profile.jpeg') }}" 
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
                <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Register</a>
            @endauth
        </div>
    </div>
</nav>