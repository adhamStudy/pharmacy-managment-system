<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script src="//unpkg.com/alpinejs" defer></script>
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
    <div class="flex justify-between items-center bg-blue-600 p-4 text-white">
        <div class="text-2xl font-bold flex gap-4">
            <a href="{{ route('welcome') }}">Pharmacy</a>
            <a href="{{ route('products') }}">Products</a>
        </div>
        @if (!Auth::check())
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            </div>
        @else
            <div class="space-x-4 flex ">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit"
                        class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{ $slot }}


</body>

</html>
