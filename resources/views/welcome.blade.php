<x-layout>
    <x-header username="{{ $username }}" today_sales="{{ $today_sales }}" :notification="$notification" :lowStockBatches="$lowStockBatches" />

    <!-- Search Form -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-blue-950 m-5 p-5 rounded-md">
        <h1 class="text-white text-2xl">Enter medicine code</h1>
        <form action="{{ route('search') }}" method="POST">
            @csrf
            <input name="search" type="text" class="p-2 m-2" placeholder="Enter medicine code" id="searchInput">
            @error('search')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <button class="px-4 py-2 bg-blue-600 text-white rounded-full" type="submit">Search</button>
        </form>

        <script>
            // Automatically focus the input field when the page loads
            window.onload = function() {
                document.getElementById('searchInput').focus();
            };
        </script>
    </div>

    <!-- Search Results -->
    @if ($search)
        <h2 class="text-2xl m-5">Search Results for "{{ $search }}"</h2>
        @if ($medicines->isEmpty())
            <p class="m-5">No results found.</p>
        @else
            <div class="m-10 bg-slate-300">
                <table class="w-full border-collapse border border-gray-800">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-2">Code</th>
                            <th class="p-2">Medicine</th>
                            <th class="p-2">Price</th>
                            <th class="p-2">Category</th>
                            <th class="p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($medicines as $medicine)
                            @if ($medicine->batches->isNotEmpty())
                                @foreach ($medicine->batches as $batch)
                                    <tr class="border border-x-gray-200 text-center">
                                        <td class="p-2">{{ $medicine->code }}</td>
                                        <td class="p-2">{{ $medicine->name }}</td>
                                        <td class="p-2">{{ $batch->selling_price }}</td>
                                        <td class="p-2">{{ $medicine->category }}</td>
                                        <td class="p-2">
                                            <form action="{{ route('add_to_cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                                                <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                                                <div class="flex items-center space-x-2">
                                                    <input type="number" name="quantity" min="1"
                                                        max="{{ $batch->remain_qty }}" value="1"
                                                        class="w-16 p-1 border rounded">
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-600 text-white rounded-full">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                                <div class="text-sm text-gray-600">
                                                    Batch: {{ $batch->batch_code }}
                                                    | Remaining: {{ $batch->remain_qty }}
                                                    | Price: ${{ $batch->selling_price }}
                                                    | Expiry: {{ $batch->expiry_date }}
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif

    <!-- Cart Component -->
    <x-cart :medicines="$medicines" />
</x-layout>
