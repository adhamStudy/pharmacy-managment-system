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
    <div class="flex h-screen">

        <!-- Sidebar -->
        {{-- <x-admin.sidebar /> --}}

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
                            {{-- <th class="border p-2">Role</th> --}}
                            <th class="border p-2">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <x-admin.user-row :user="$user" />
                        @endforeach
                    </tbody>
                </table>

                <x-admin.create-user-model />

            </div>

            <div class="rounded-sm shadow-md p-5 bg-white mt-5">
                <x-admin.create-medicine-modal :suppliers="$suppliers" />
            </div>
        </main>

    </div>

</x-layout>
