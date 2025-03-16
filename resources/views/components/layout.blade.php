<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <div class="flex justify-between items-center bg-blue-600 p-4 text-white shadow-lg sticky top-0 z-50">
        <!-- Left Side: Brand and Links -->
        <div class="text-2xl font-bold flex gap-6 items-center">
            <a href="{{ route('welcome') }}" class="hover:text-blue-200 transition-colors duration-300">Pharmacy</a>
            <a href="{{ route('products') }}" class="hover:text-blue-200 transition-colors duration-300">Products</a>
            <a href="{{ route('sales') }}" class="hover:text-blue-200 transition-colors duration-300">Reports</a>
        </div>

        <!-- Right Side: Auth Links -->
        @if (!Auth::check())
            <div class="flex gap-6 items-center">
                <a href="{{ route('login') }}" class="hover:text-blue-200 transition-colors duration-300">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                    Register
                </a>
            </div>
        @else
            <div class="flex gap-6 items-center">
                <a href="{{ route('cancel') }}" class="hover:text-blue-200 transition-colors duration-300">المرتجعات</a>
                <a href="{{ route('dashboard') }}"
                    class="hover:text-blue-200 transition-colors duration-300">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="hover:text-blue-200 transition-colors duration-300 flex items-center gap-2">
                        <!-- Power Icon (Logout) -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{ $slot }}


</body>

</html>
