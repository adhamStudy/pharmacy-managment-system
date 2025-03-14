@props(['sales' => [], 'total_sales' => '0', 'selectedMonth' => null])

<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-800">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2 text-center">Order ID</th>
                <th class="p-2 text-center">Amount Price</th>
                <th class="p-2 text-center">Payment Method</th>
                <th class="p-2 text-center">Status</th>
                <th class="p-2 text-center">Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sales as $sale)
                <tr class="border border-x-gray-200">
                    <td class="p-2 text-center">{{ $sale->id }}</td>
                    <td class="p-2 text-center">{{ $sale->total_amount }}</td>
                    <td class="p-2 text-center">Cash</td>
                    <td class="p-2 text-center">{{ $sale->status }}</td>
                    <td class="p-2 text-center  "> <a
                            href="{{ route('reports.order.details', ['order' => $sale->id]) }}"
                            class=" bg-green-600 text-white px-4 py-1  rounded-sm">Download</a> </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-2 text-center">No Sales This Month</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@php
    $formattedMonth = $selectedMonth ? \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y') : 'N/A';
@endphp

<h1 class="mt-4 text-lg font-bold text-center">
    Total Sales for {{ $formattedMonth }}: {{ $total_sales }}
</h1>
