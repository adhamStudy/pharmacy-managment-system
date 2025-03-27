{{-- <div class="bg-white p-5 rounded shadow-md">
    

</div> --}}
@props(['users' => []])
<x-layouts.admin>
    <h2 class="text-xl font-bold mb-3">Manage Users</h2>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Name</th>
                <th class="border p-2">Email</th>

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
</x-layouts.admin>
