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
        <tbody>
            @foreach ($medicines as $medicine)
                @if ($medicine->batches->isEmpty())
                    {{-- Show medicine even if no batches exist --}}
                    <tr class="border border-gray-200">
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
                            <td class="p-0.5">{{ $medicine->status }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>
</div>
