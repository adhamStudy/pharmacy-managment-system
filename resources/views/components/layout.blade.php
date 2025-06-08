<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('CLIENT_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <div class="bg-gradient-to-r from-blue-900 to-blue-900 px-6 py-3 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center">
                <!-- Left Navigation -->
                <div class="flex items-center space-x-8">
                    <!-- Logo -->
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        <x-application-logo class="h-8 w-auto text-white" />
                        <span class="text-xl font-semibold text-white">{{ env('CLIENT_NAME') }}</span>
                    </a>

                    <!-- Main Navigation -->
                    <nav class="hidden md:flex items-center space-x-6">
                        <a href="{{ route('products') }}"
                            class="text-white hover:text-teal-100 transition-colors duration-200 font-medium text-sm uppercase tracking-wider">
                            Products
                        </a>
                        <a href="{{ route('sales') }}"
                            class="text-white hover:text-teal-100 transition-colors duration-200 font-medium text-sm uppercase tracking-wider">
                            Reports
                        </a>
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-white hover:text-teal-100 transition-colors duration-200 font-medium text-sm uppercase tracking-wider">
                            Admin
                        </a>
                    </nav>
                </div>

                <!-- Right Navigation -->
                <div class="flex items-center space-x-6">
                    @if (!Auth::check())
                        <!-- Guest Navigation -->
                        <a href="{{ route('login') }}"
                            class="text-white hover:text-teal-100 transition-colors duration-200 font-medium text-sm">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-white text-teal-600 px-4 py-2 rounded-md hover:bg-teal-50 transition-colors duration-200 font-medium text-sm shadow-sm">
                            Register
                        </a>
                    @else
                        <!-- Authenticated Navigation -->
                        <a href="{{ route('cancel') }}"
                            class="text-white hover:text-teal-100 transition-colors duration-200 font-medium text-sm hidden md:block">
                            المرتجعات
                        </a>
                        <a href="/profile"
                            class="text-white hover:text-teal-100 transition-colors duration-200 font-medium text-sm hidden md:block">
                            Profile
                        </a>

                        <!-- User Dropdown (Mobile) -->
                        <div class="md:hidden relative">
                            <button id="mobile-menu-button" class="text-white focus:outline-none">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>

                        <!-- Desktop Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                            @csrf
                            <button type="submit"
                                class="flex items-center space-x-1 text-white hover:text-teal-100 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span class="text-sm font-medium">Logout</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        {{-- @if (Auth::check())
            <div id="mobile-menu" class="hidden md:hidden bg-teal-700 px-6 py-4">
                <div class="flex flex-col space-y-4">
                    <a href="{{ route('cancel') }}"
                        class="text-white hover:text-teal-100 transition-colors duration-200">
                        المرتجعات
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="text-white hover:text-teal-100 transition-colors duration-200">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center space-x-2 text-white hover:text-teal-100 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        @endif --}}
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    {{ $slot }}


</body>

</html>
