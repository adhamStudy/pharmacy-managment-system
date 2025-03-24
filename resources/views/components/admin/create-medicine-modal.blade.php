@props(['suppliers' => []])

<div class=" mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create Medicine</h2>

    <form action="{{ route('admin.storeMedicine') }}" method="POST">

        @csrf

        {{-- Supplier Selection --}}
        <div>
            <label for="supplier_id" class="block text-gray-700 font-medium">Supplier</label>
            <select id="supplier_id" name="supplier_id"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                <option value="">Select Supplier</option>
                @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Medicine Name --}}
        <div>
            <label for="name" class="block text-gray-700 font-medium">Medicine Name</label>
            <input type="text" id="name" name="name"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
        </div>

        {{-- Category --}}
        <div>
            <label for="category" class="block text-gray-700 font-medium">Category</label>
            <input type="text" id="category" name="category"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
        </div>

        {{-- Registered Quantity --}}
        <div>
            <label for="registered_qty" class="block text-gray-700 font-medium">Registered Quantity</label>
            <input type="number" id="registered_qty" name="registered_qty"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" min="1"
                required>
        </div>

        {{-- Expiry Date --}}
        <div>
            <label for="expiry_date" class="block text-gray-700 font-medium">Expiry Date</label>
            <input type="date" id="expiry_date" name="expiry_date"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
        </div>

        {{-- Selling Price --}}
        <div>
            <label for="selling_price" class="block text-gray-700 font-medium">Selling Price</label>
            <input type="number" id="selling_price" name="selling_price"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" step="0.01"
                min="0" required>
        </div>

        {{-- Profit --}}
        <div>
            <label for="profit" class="block text-gray-700 font-medium">Profit</label>
            <input type="number" id="profit" name="profit"
                class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" step="0.01"
                min="0" required>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Save
                Medicine</button>
        </div>
    </form>
</div>
