<x-layout>
    <h2 class="font-bold text-red-500">Here this is Products Page</h2>

    <div class="m-4 bg-slate-300 p-4 rounded-lg">
        <!-- Search and Category Filter Form -->
        <form action="{{ route('products') }}" method="GET" class="mb-4">
            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                <!-- Search Input -->
                <input type="text" name="search" placeholder="Search by product name or code"
                    value="{{ $searchTerm }}"
                    class="w-full p-0.5 rounded-md bg-white shadow-sm focus:ring-2 focus:ring-blue-500">

                <!-- Category Dropdown -->
                <select name="category"
                    class="w-full p-0.5 rounded-md bg-white shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option value="all">Show All</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full md:w-auto px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                    Filter
                </button>
            </div>
        </form>

        <!-- Product Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-800">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-0.5">Code</th>
                        <th class="p-0.5">Medicine</th>
                        <th class="p-0.5">Category</th>
                        <th class="p-0.5">Registered Qty</th>
                        <th class="p-0.5">Sold Qty</th>
                        <th class="p-0.5">Remain Qty</th>
                        <th class="p-0.5">Registered</th>
                        <th class="p-0.5 bg-red-500">Expiry Date</th>
                        <th class="p-0.5">Remark</th>
                        <th class="p-0.5">Selling price</th>
                        <th class="p-0.5">Profit</th>
                        <th class="p-0.5">Status</th>
                        <th class="p-0.5">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border border-x-gray-200">
                            <td class="p-0.5">{{ $product->code }}</td>
                            <td class="p-0.5">{{ $product->name }}</td>
                            <td class="p-0.5">{{ $product->category }}</td>
                            <td class="p-0.5">{{ $product->registered_qty }}</td>
                            <td class="p-0.5">{{ $product->sold_qty }}</td>
                            <td class="p-0.5">{{ $product->remain_qty }}</td>
                            <td class="p-0.5">{{ $product->registered_date }}</td>
                            <td class="p-0.5 bg-red-500 text-white font-bold">{{ $product->expiry_date }}</td>
                            <td class="p-0.5">{{ $product->remark }}</td>
                            <td class="p-0.5">{{ $product->selling_price }}</td>
                            <td class="p-0.5">{{ $product->profit }}</td>
                            <td class="p-0.5">{{ $product->status }}</td>
                            <td class="p-0.5">
                                <div class="flex justify-between">
                                    <a class="bg-green-600 text-white transition-colors hover:bg-green-700 p-0.5 rounded-md"
                                        href="">Update</a>
                                    <a class="bg-red-500 text-white p-0.5 hover:bg-red-700 transition-colors rounded-md"
                                        href="">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->appends(['search' => $searchTerm, 'category' => $category])->links() }}
        </div>
    </div>
</x-layout>
