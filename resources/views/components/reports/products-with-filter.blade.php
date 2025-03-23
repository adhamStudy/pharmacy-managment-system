<div class="overflow-x-auto">
    <!-- Search Form -->
    <div class="mb-4 mx-2">
        <form method="GET">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter Code or Name..."
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
        </form>
    </div>

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
                <th class="p-0.5 bg-red-500">Days</th>
                <th class="p-0.5 bg-red-500">Expiry Date</th>
                <th class="p-0.5">Remark</th>
                <th class="p-0.5">Selling price</th>
                <th class="p-0.5">Profit</th>
                <th class="p-0.5">Status</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($batches as $batch)
                <tr class="border border-x-gray-200">
                    <td class="p-0.5">{{ $batch->medicine->code }}</td>
                    <td class="p-0.5">{{ $batch->medicine->name }}</td>
                    <td class="p-0.5">{{ $batch->medicine->category }}</td>
                    <td class="p-0.5">{{ $batch->registered_qty }}</td>
                    <td class="p-0.5">{{ $batch->sold_qty }}</td>
                    <td class="p-0.5">{{ $batch->remain_qty }}</td>
                    <td class="p-0.5">{{ $batch->registered_date }}</td>
                    <td class="p-0.5 bg-red-500 text-white font-bold">{{ $batch->days_remaining }}</td>
                    <td class="p-0.5 bg-red-500 text-white font-bold">{{ $batch->expiry_date }}</td>
                    <td class="p-0.5">{{ $batch->remark }}</td>
                    <td class="p-0.5">{{ $batch->selling_price }}</td>
                    <td class="p-0.5">{{ $batch->profit }}</td>
                    <td class="p-0.5">{{ $batch->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="p-2 text-center text-red-500 font-bold">No Medicines Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $batches->links() }}
</div>
