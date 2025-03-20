<tr class="bg-gray-100 text-center">
    <td class="border p-2">{{ $user->id }}</td>
    <td class="border p-2">{{ $user->name }}</td>
    <td class="border p-2">{{ $user->email }}</td>
    {{-- <td class="border p-2">{{ $user->role }}</td> --}}
    <td class="border p-2 text-center">
        @if ($user->active)
            <span class="text-green-500 font-semibold">Active</span>
            <form action="{{ route('admin.deactivate', $user->id) }}" method="POST" class="inline">
                @csrf
                @method('PUT')
                <button type="submit"
                    class="bg-red-500 py-1 px-3 hover:bg-red-700 text-white rounded-md transition-all">
                    Deactivate
                </button>
            </form>
        @else
            <span class="text-red-500 font-semibold">Inactive</span>
            <form action="{{ route('admin.activate', $user->id) }}" method="POST" class="inline">
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
