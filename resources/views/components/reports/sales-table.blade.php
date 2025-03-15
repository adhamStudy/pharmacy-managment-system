@props(['sales' => [], 'total_sales' => '0', 'selectedMonth' => null])

<!-- Alpine.js Search Component -->
<div x-data="{ searchOrderId: '' }">
    <!-- Search Input -->
    <div class="mb-4 mx-8">
        <label for="searchOrderId" class="block text-lg font-medium text-gray-700">ادخل رقم الاوردر</label>
        <input type="text" id="searchOrderId" x-model="searchOrderId" placeholder="Enter Order ID..."
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />
    </div>

    <!-- Sales Table -->
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
                    <tr x-show="searchOrderId === '' || '{{ $sale->id }}'.includes(searchOrderId)"
                        class="border border-x-gray-200">
                        <td class="p-2 text-center">{{ $sale->id }}</td>
                        <td class="p-2 text-center">{{ $sale->total_amount }}</td>
                        <td class="p-2 text-center">Cash</td>
                        <td class="p-2 text-center">{{ $sale->status }}</td>
                        <td class="p-2 text-center">
                            <a href="{{ route('reports.order.details', ['order' => $sale->id]) }}"
                                class="bg-green-600 text-white px-4 py-1 rounded-sm">
                                Download
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center">No Sales This Month</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@php
    $formattedMonth = $selectedMonth ? \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('F Y') : 'N/A';
@endphp

<h1 class="mt-4 text-lg font-bold text-center">
    Total Sales for {{ $formattedMonth }}: {{ $total_sales }}
</h1>
