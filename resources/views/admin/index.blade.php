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

            <h1 class="text-3xl font-bold mb-5">Welcome {{ Auth::user()->name }}</h1>


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
                            <th class="border p-2">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-gray-100 text-center">
                                <td class="border p-2">{{ $user->id }}</td>
                                <td class="border p-2">{{ $user->name }}</td>
                                <td class="border p-2">{{ $user->email }}</td>
                                <td class="border p-2">{{ $user->role }}</td>
                                <td class="border p-2 text-center">
                                    @if ($user->active)
                                        <span class="text-green-500 font-semibold">Active</span>
                                        <form action="{{ route('admin.deactivate', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="bg-red-500 py-1 px-3 hover:bg-red-700 text-white rounded-md transition-all">
                                                Deactivate
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-red-500 font-semibold">Inactive</span>
                                        <form action="{{ route('admin.activate', $user->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="bg-green-500 py-1 px-3 hover:bg-green-700 text-white rounded-md transition-all">
                                                Activate
                                            </button>
                                        </form>
                                    @endif
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button class="bg-green-500 text-white px-4 py-2 rounded mt-3">Create User</button>
            </div>

        </main>

    </div>

</x-layout>
