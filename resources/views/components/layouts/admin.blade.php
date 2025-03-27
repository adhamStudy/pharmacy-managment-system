<x-layout>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
            {{ session('error') }}
        </div>
    @endif



    <ul
        class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow-sm sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 border-r border-gray-200 dark:border-gray-700 rounded-s-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none {{ request()->routeIs('admin.dashboard') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }}">Profile</a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="{{ route('admin.users') }}"
                class="inline-block w-full p-4 border-r border-gray-200 dark:border-gray-700 focus:ring-4 focus:ring-blue-300 focus:outline-none {{ request()->routeIs('admin.users') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }}">Users</a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="{{ route('admin.medicines') }}"
                class="inline-block w-full p-4 border-r border-gray-200 dark:border-gray-700 focus:ring-4 focus:ring-blue-300 focus:outline-none {{ request()->routeIs('admin.medicines') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }}">Medicines</a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 border-s-0 border-gray-200 dark:border-gray-700 rounded-e-lg focus:ring-4 focus:outline-none focus:ring-blue-300 {{ request()->routeIs('admin.invoice') ? 'text-gray-900 bg-gray-100 dark:bg-gray-700 dark:text-white' : 'bg-white hover:text-gray-700 hover:bg-gray-50 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700' }}">Invoice</a>
        </li>
    </ul>

    <!-- Main Content -->
    <main class="p-6">
        <h1 class="text-2xl font-semibold mb-4">Admin Dashboard</h1>
        <!-- The Slot -->
        {{ $slot }}
    </main>

</x-layout>
