<!-- Add Alpine.js in your layout if not already included -->

<div x-data="{ open: false }">
    <!-- Button to open the modal -->
    <button @click="open = true" class="bg-green-500 text-white px-4 py-2 rounded mt-3">
        Add User
    </button>

    <!-- Modal -->
    <div x-show="open" x-transition.opacity x-transition.scale
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Create User</h2>

            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div class="mb-2">
                    <label class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full border rounded px-3 py-2 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-sm font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex justify-between mt-4">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create</button>
                    <button type="button" @click="open = false" class="bg-gray-400 px-4 py-2 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
