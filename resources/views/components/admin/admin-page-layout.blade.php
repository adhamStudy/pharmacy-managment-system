<x-layout>

    {{-- <x-admin.admin-page-layout :suppliers="$suppliers">

    </x-admin.admin-page-layout> --}}

    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select your country</label>
        <select id="tabs"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option>Profile</option>
            <option>Dashboard</option>
            <option>setting</option>
            <option>Invoioce</option>
        </select>
    </div>
    <ul
        class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow-sm sm:flex dark:divide-gray-700 dark:text-gray-400">
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none dark:bg-gray-700 dark:text-white"
                aria-current="page">Profile</a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Dashboard</a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Settings</a>
        </li>
        <li class="w-full focus-within:z-10">
            <a href="#"
                class="inline-block w-full p-4 bg-white border-s-0 border-gray-200 dark:border-gray-700 rounded-e-lg hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">Invoice</a>
        </li>
    </ul>
    <main class="flex-1 p-6">
        <h1 class="text-2xl font-semibold mb-4">Admin Dashboard</h1>
        {{ $slot }}
    </main>


</x-layout>
