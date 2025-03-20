<x-layout>

    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-5">
            <h2 class="text-2xl font-bold mb-5">Admin Panel</h2>
            <nav>
                <ul>
                    <li class="mb-2"><a href="#" class="block py-2 px-3 hover:bg-blue-700 rounded">Dashboard</a>
                    </li>
                    <li class="mb-2"><a href="#" class="block py-2 px-3 hover:bg-blue-700 rounded">Manage
                            Medicines</a></li>
                    <li class="mb-2"><a href="#" class="block py-2 px-3 hover:bg-blue-700 rounded">Manage
                            Users</a></li>
                    <li class="mb-2"><a href="#"
                            class="block py-2 px-3 hover:bg-blue-700 rounded text-red-400">Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">

            <h1 class="text-3xl font-bold mb-5">Welcome, Admin</h1>

            <!-- Medicine Management -->
            <div class="bg-white p-5 rounded shadow-md mb-5">
                <h2 class="text-xl font-bold mb-3">Manage Medicines</h2>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Stock</th>
                            <th class="border p-2">Price</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border p-2">1</td>
                            <td class="border p-2">Panadol</td>
                            <td class="border p-2">50</td>
                            <td class="border p-2">$5.00</td>
                            <td class="border p-2">
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-2">2</td>
                            <td class="border p-2">Amoxicillin</td>
                            <td class="border p-2">20</td>
                            <td class="border p-2">$12.00</td>
                            <td class="border p-2">
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button class="bg-green-500 text-white px-4 py-2 rounded mt-3">Add Medicine</button>
            </div>

            <!-- User Management -->
            <div class="bg-white p-5 rounded shadow-md">
                <h2 class="text-xl font-bold mb-3">Manage Users</h2>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Name</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Role</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border p-2">1</td>
                            <td class="border p-2">John Doe</td>
                            <td class="border p-2">john@example.com</td>
                            <td class="border p-2">Admin</td>
                            <td class="border p-2">
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="border p-2">2</td>
                            <td class="border p-2">Jane Smith</td>
                            <td class="border p-2">jane@example.com</td>
                            <td class="border p-2">User</td>
                            <td class="border p-2">
                                <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button class="bg-green-500 text-white px-4 py-2 rounded mt-3">Create User</button>
            </div>

        </main>

    </div>

</x-layout>
