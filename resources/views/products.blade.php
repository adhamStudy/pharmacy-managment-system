<x-layout>
    <div class="mx-4 my-4">
        <h1 class="text-xl font-bold mb-4">Medicine List</h1>

        <!-- Server-side Search & Filter Form -->
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

        <!-- Client-side Filters -->
        <div class="mb-4 flex gap-3 flex-wrap">
            <div class="flex items-center">
                <label class="mr-2 font-medium">Quick Filters:</label>
            </div>

            <button id="filter-expired"
                class="px-3 py-1 bg-red-100 text-red-700 border border-red-300 rounded hover:bg-red-200">
                Expired Medicines
            </button>

            <button id="filter-expiring-soon"
                class="px-3 py-1 bg-orange-100 text-orange-700 border border-orange-300 rounded hover:bg-orange-200">
                Expiring Soon (30 Days)
            </button>

            <button id="filter-low-stock"
                class="px-3 py-1 bg-yellow-100 text-yellow-700 border border-yellow-300 rounded hover:bg-yellow-200">
                Low Stock (< 10) </button>

                    <button id="filter-out-of-stock"
                        class="px-3 py-1 bg-gray-100 text-gray-700 border border-gray-300 rounded hover:bg-gray-200">
                        Out of Stock
                    </button>

                    <button id="reset-filters"
                        class="px-3 py-1 bg-blue-100 text-blue-700 border border-blue-300 rounded hover:bg-blue-200">
                        Reset Filters
                    </button>
        </div>

        <!-- Sorting Options -->
        <div class="mb-4">
            <label class="mr-2 font-medium">Sort By:</label>
            <select id="sort-select" class="border p-1 rounded">
                <option value="expiry-asc">Expiry Date (Nearest First)</option>
                <option value="expiry-desc">Expiry Date (Furthest First)</option>
                <option value="stock-asc">Stock Level (Lowest First)</option>
                <option value="stock-desc">Stock Level (Highest First)</option>
                <option value="price-asc">Price (Low to High)</option>
                <option value="price-desc">Price (High to Low)</option>
            </select>
        </div>

        <!-- Summary Statistics -->
        <div class="mb-4 p-3 bg-gray-50 rounded border">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="p-2 bg-white rounded shadow">
                    <div class="text-sm text-gray-500">Total Medicines</div>
                    <div class="text-xl font-bold" id="total-medicines">{{ $medicines->total() }}</div>
                </div>
                <div class="p-2 bg-white rounded shadow">
                    <div class="text-sm text-gray-500">Expired Items</div>
                    <div class="text-xl font-bold text-red-600" id="expired-count">0</div>
                </div>
                <div class="p-2 bg-white rounded shadow">
                    <div class="text-sm text-gray-500">Low Stock Items</div>
                    <div class="text-xl font-bold text-yellow-600" id="low-stock-count">0</div>
                </div>
                <div class="p-2 bg-white rounded shadow">
                    <div class="text-sm text-gray-500">Total Value</div>
                    <div class="text-xl font-bold text-green-600" id="total-value">0</div>
                </div>
            </div>
        </div>

        <!-- Medicine Table -->
        <div class="overflow-x-auto">
            <table id="medicines-table" class="w-full border-collapse border border-gray-800">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-1 cursor-pointer" data-sort="code">Code</th>
                        <th class="p-1 cursor-pointer" data-sort="name">Medicine</th>
                        <th class="p-1 cursor-pointer" data-sort="category">Category</th>
                        <th class="p-1 cursor-pointer" data-sort="batch">Batch Code</th>
                        <th class="p-1 cursor-pointer" data-sort="registered">Registered Qty</th>
                        <th class="p-1 cursor-pointer" data-sort="sold">Sold Qty</th>
                        <th class="p-1 cursor-pointer" data-sort="remain">Remain Qty</th>
                        <th class="p-1 cursor-pointer" data-sort="registered-date">Registered</th>
                        <th class="p-1 bg-red-500 cursor-pointer" data-sort="expiry">Expiry Date</th>
                        <th class="p-1">Remark</th>
                        <th class="p-1 cursor-pointer" data-sort="price">Selling Price</th>
                        <th class="p-1 cursor-pointer" data-sort="profit">Profit</th>
                        <th class="p-1 cursor-pointer" data-sort="status">Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($medicines as $medicine)
                        @if ($medicine->batches->isEmpty())
                            <tr class="border border-gray-200 bg-gray-50 medicine-row" data-code="{{ $medicine->code }}"
                                data-name="{{ $medicine->name }}" data-category="{{ $medicine->category }}"
                                data-status="{{ $medicine->status }}">
                                <td class="p-1">{{ $medicine->code }}</td>
                                <td class="p-1">{{ $medicine->name }}</td>
                                <td class="p-1">{{ $medicine->category }}</td>
                                <td colspan="9" class="p-1 text-center text-gray-500">No Batches Available</td>
                                <td class="p-1">{{ $medicine->status }}</td>
                            </tr>
                        @else
                            @foreach ($medicine->batches as $batch)
                                <tr class="border border-gray-200 medicine-row" data-code="{{ $medicine->code }}"
                                    data-name="{{ $medicine->name }}" data-category="{{ $medicine->category }}"
                                    data-batch="{{ $batch->batch_code }}"
                                    data-registered="{{ $batch->registered_qty }}"
                                    data-sold="{{ $batch->sold_qty }}" data-remain="{{ $batch->remain_qty }}"
                                    data-registered-date="{{ $batch->registered_date }}"
                                    data-expiry="{{ $batch->expiry_date }}" data-price="{{ $batch->selling_price }}"
                                    data-profit="{{ $batch->profit }}" data-status="{{ $batch->status }}">
                                    <td class="p-1">{{ $medicine->code }}</td>
                                    <td class="p-1">{{ $medicine->name }}</td>
                                    <td class="p-1">{{ $medicine->category }}</td>
                                    <td class="p-1">{{ $batch->batch_code }}</td>
                                    <td class="p-1">{{ $batch->registered_qty }}</td>
                                    <td class="p-1">{{ $batch->sold_qty }}</td>
                                    <td class="p-1">{{ $batch->remain_qty }}</td>
                                    <td class="p-1">{{ $batch->registered_date }}</td>
                                    <td
                                        class="p-1 {{ isExpired($batch->expiry_date) ? 'bg-red-500 text-white font-bold' : (isExpiringSoon($batch->expiry_date) ? 'bg-orange-300 font-bold' : '') }}">
                                        {{ $batch->expiry_date }}
                                    </td>
                                    <td class="p-1">{{ $batch->remark }}</td>
                                    <td class="p-1">{{ $batch->selling_price }}</td>
                                    <td class="p-1">{{ $batch->profit }}</td>
                                    <td class="p-1">{{ $batch->status }}</td>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Helper function to check if a date is expired
            function isExpired(dateStr) {
                const today = new Date();
                const expiryDate = new Date(dateStr);
                return expiryDate < today;
            }

            // Helper function to check if a date is expiring soon (within 30 days)
            function isExpiringSoon(dateStr) {
                const today = new Date();
                const expiryDate = new Date(dateStr);
                const diffTime = expiryDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                return diffDays >= 0 && diffDays <= 30;
            }

            // Update statistics counters
            function updateStatistics() {
                const visibleRows = document.querySelectorAll('tr.medicine-row:not(.hidden)');
                const expiredCount = document.getElementById('expired-count');
                const lowStockCount = document.getElementById('low-stock-count');
                const totalValue = document.getElementById('total-value');

                let expired = 0;
                let lowStock = 0;
                let value = 0;

                visibleRows.forEach(row => {
                    const expiryDate = row.getAttribute('data-expiry');
                    const remainQty = parseInt(row.getAttribute('data-remain') || '0');
                    const price = parseFloat(row.getAttribute('data-price') || '0');

                    if (expiryDate && isExpired(expiryDate)) {
                        expired++;
                    }

                    if (remainQty > 0 && remainQty < 10) {
                        lowStock++;
                    }

                    if (remainQty > 0 && price > 0) {
                        value += remainQty * price;
                    }
                });

                expiredCount.textContent = expired;
                lowStockCount.textContent = lowStock;
                totalValue.textContent = value.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            // Apply filters
            function applyFilters() {
                const rows = document.querySelectorAll('tr.medicine-row');

                rows.forEach(row => {
                    row.classList.remove('hidden');
                });

                updateStatistics();
            }

            // Filter expired medicines
            document.getElementById('filter-expired').addEventListener('click', function() {
                const rows = document.querySelectorAll('tr.medicine-row');

                rows.forEach(row => {
                    const expiryDate = row.getAttribute('data-expiry');

                    if (!expiryDate || !isExpired(expiryDate)) {
                        row.classList.add('hidden');
                    } else {
                        row.classList.remove('hidden');
                    }
                });

                updateStatistics();
            });

            // Filter medicines expiring soon
            document.getElementById('filter-expiring-soon').addEventListener('click', function() {
                const rows = document.querySelectorAll('tr.medicine-row');

                rows.forEach(row => {
                    const expiryDate = row.getAttribute('data-expiry');

                    if (!expiryDate || !isExpiringSoon(expiryDate) || isExpired(expiryDate)) {
                        row.classList.add('hidden');
                    } else {
                        row.classList.remove('hidden');
                    }
                });

                updateStatistics();
            });

            // Filter low stock medicines
            document.getElementById('filter-low-stock').addEventListener('click', function() {
                const rows = document.querySelectorAll('tr.medicine-row');

                rows.forEach(row => {
                    const remainQty = parseInt(row.getAttribute('data-remain') || '0');

                    if (remainQty === 0 || remainQty >= 10) {
                        row.classList.add('hidden');
                    } else {
                        row.classList.remove('hidden');
                    }
                });

                updateStatistics();
            });

            // Filter out of stock medicines
            document.getElementById('filter-out-of-stock').addEventListener('click', function() {
                const rows = document.querySelectorAll('tr.medicine-row');

                rows.forEach(row => {
                    const remainQty = parseInt(row.getAttribute('data-remain') || '0');

                    if (remainQty > 0) {
                        row.classList.add('hidden');
                    } else {
                        row.classList.remove('hidden');
                    }
                });

                updateStatistics();
            });

            // Reset all filters
            document.getElementById('reset-filters').addEventListener('click', function() {
                const rows = document.querySelectorAll('tr.medicine-row');

                rows.forEach(row => {
                    row.classList.remove('hidden');
                });

                updateStatistics();
            });

            // Sorting functionality
            document.getElementById('sort-select').addEventListener('change', function() {
                const sortValue = this.value;
                const table = document.getElementById('medicines-table');
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr.medicine-row:not(.hidden)'));

                rows.sort((a, b) => {
                    if (sortValue === 'expiry-asc') {
                        const dateA = new Date(a.getAttribute('data-expiry') || '9999-12-31');
                        const dateB = new Date(b.getAttribute('data-expiry') || '9999-12-31');
                        return dateA - dateB;
                    } else if (sortValue === 'expiry-desc') {
                        const dateA = new Date(a.getAttribute('data-expiry') || '0000-01-01');
                        const dateB = new Date(b.getAttribute('data-expiry') || '0000-01-01');
                        return dateB - dateA;
                    } else if (sortValue === 'stock-asc') {
                        return parseInt(a.getAttribute('data-remain') || '0') - parseInt(b
                            .getAttribute('data-remain') || '0');
                    } else if (sortValue === 'stock-desc') {
                        return parseInt(b.getAttribute('data-remain') || '0') - parseInt(a
                            .getAttribute('data-remain') || '0');
                    } else if (sortValue === 'price-asc') {
                        return parseFloat(a.getAttribute('data-price') || '0') - parseFloat(b
                            .getAttribute('data-price') || '0');
                    } else if (sortValue === 'price-desc') {
                        return parseFloat(b.getAttribute('data-price') || '0') - parseFloat(a
                            .getAttribute('data-price') || '0');
                    }
                    return 0;
                });

                rows.forEach(row => tbody.appendChild(row));
            });

            // Table header sorting
            document.querySelectorAll('th[data-sort]').forEach(header => {
                header.addEventListener('click', function() {
                    const sortKey = this.getAttribute('data-sort');
                    const table = document.getElementById('medicines-table');
                    const tbody = table.querySelector('tbody');
                    const rows = Array.from(tbody.querySelectorAll('tr.medicine-row:not(.hidden)'));

                    // Toggle sort direction
                    const currentDirection = this.getAttribute('data-direction') || 'asc';
                    const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';

                    // Clear all headers' direction
                    document.querySelectorAll('th[data-sort]').forEach(h => {
                        h.removeAttribute('data-direction');
                        h.classList.remove('bg-blue-700');
                    });

                    // Set this header's direction
                    this.setAttribute('data-direction', newDirection);
                    if (!this.classList.contains('bg-red-500')) {
                        this.classList.add('bg-blue-700');
                    }

                    rows.sort((a, b) => {
                        let valueA = a.getAttribute('data-' + sortKey) || '';
                        let valueB = b.getAttribute('data-' + sortKey) || '';

                        // Convert to numbers if possible
                        if (!isNaN(valueA) && !isNaN(valueB)) {
                            valueA = parseFloat(valueA);
                            valueB = parseFloat(valueB);
                        }

                        // Date comparison
                        if (sortKey === 'expiry' || sortKey === 'registered-date') {
                            valueA = new Date(valueA || '9999-12-31');
                            valueB = new Date(valueB || '9999-12-31');
                        }

                        // Perform the comparison
                        if (valueA < valueB) return newDirection === 'asc' ? -1 : 1;
                        if (valueA > valueB) return newDirection === 'asc' ? 1 : -1;
                        return 0;
                    });

                    rows.forEach(row => tbody.appendChild(row));
                });
            });

            // Initial statistics update
            updateStatistics();
        });
    </script>
</x-layout>

<?php
function isExpired($date)
{
    return strtotime($date) < strtotime('today');
}

function isExpiringSoon($date)
{
    $days = (strtotime($date) - strtotime('today')) / (60 * 60 * 24);
    return $days >= 0 && $days <= 30;
}
?>
