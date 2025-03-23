<x-layout>
    <div class="mx-4 my-4">
        <h1 class="text-xl font-bold mb-4">Medicine List</h1>

        <!-- Search & Filter Form -->
        <form method="GET" action="{{ route('products') }}" class="mb-4 flex gap-3">
            <input type="text" name="search" placeholder="Search by name or code" value="{{ request('search') }}"
                class="border p-2 rounded w-1/3" />

            <select name="category" class="border p-2 rounded">
                <option value="">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </form>

        <!-- Medicine Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-800">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-0.5">Code</th>
                        <th class="p-0.5">Medicine</th>
                        <th class="p-0.5">Category</th>
                        <th class="p-0.5">Batch Code</th>
                        <th class="p-0.5">Registered Qty</th>
                        <th class="p-0.5">Sold Qty</th>
                        <th class="p-0.5">Remain Qty</th>
                        <th class="p-0.5">Registered</th>
                        <th class="p-0.5 bg-red-500">Expiry Date</th>
                        <th class="p-0.5">Remark</th>
                        <th class="p-0.5">Selling Price</th>
                        <th class="p-0.5">Profit</th>
                        <th class="p-0.5">Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($medicines as $medicine)
                        @if ($medicine->batches->isEmpty())
                            <tr class="border border-gray-200 bg-gray-50 ">
                                <td class="p-0.5">{{ $medicine->code }}</td>
                                <td class="p-0.5">{{ $medicine->name }}</td>
                                <td class="p-0.5">{{ $medicine->category }}</td>
                                <td colspan="9" class="p-0.5 text-center text-gray-500">No Batches Available</td>
                                <td class="p-0.5">{{ $medicine->status }}</td>
                            </tr>
                        @else
                            @foreach ($medicine->batches as $batch)
                                <tr class="border border-gray-200">
                                    <td class="p-0.5">{{ $medicine->code }}</td>
                                    <td class="p-0.5">{{ $medicine->name }}</td>
                                    <td class="p-0.5">{{ $medicine->category }}</td>
                                    <td class="p-0.5">{{ $batch->batch_code }}</td>
                                    <td class="p-0.5">{{ $batch->registered_qty }}</td>
                                    <td class="p-0.5">{{ $batch->sold_qty }}</td>
                                    <td class="p-0.5">{{ $batch->remain_qty }}</td>
                                    <td class="p-0.5">{{ $batch->registered_date }}</td>
                                    <td class="p-0.5 bg-red-500 text-white font-bold">{{ $batch->expiry_date }}</td>
                                    <td class="p-0.5">{{ $batch->remark }}</td>
                                    <td class="p-0.5">{{ $batch->selling_price }}</td>
                                    <td class="p-0.5">{{ $batch->profit }}</td>
                                    <td class="p-0.5">{{ $batch->status }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $medicines->appends(request()->query())->links() }}
        </div>

    </div>
</x-layout>
