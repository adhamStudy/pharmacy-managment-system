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
