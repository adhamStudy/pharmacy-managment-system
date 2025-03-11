<x-layout>
    <x-header />
    <!-- Search Form -->
    <div class="bg-blue-950 m-5 p-5">
        <h1 class="text-white text-2xl">Enter medicine code</h1>
        <form action="{{ route('search') }}" method="POST">
            @csrf
            <input name="search" type="text" class="p-2 m-2" placeholder="Enter medicine code">
            @error('search')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <button class="px-4 py-2 bg-blue-600 text-white rounded-full" type="submit">Search</button>
        </form>
    </div>
    {{-- {{ dd($cart) }} --}}
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
                            <th class="p-2">Category</th>
                            <th class="p-2">Registered Qty</th>
                            <th class="p-2">Sold Qty</th>
                            <th class="p-2">Remain Qty</th>
                            <th class="p-2">Registered</th>
                            <th class="p-2">Expiry</th>
                            <th class="p-2">Remark</th>
                            <th class="p-2">Selling price</th>
                            <th class="p-2">Profit</th>
                            <th class="p-2">Status</th>
                            <th class="p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicines as $medicine)
                            <tr class="border border-x-gray-200">
                                <td class="p-2">{{ $medicine->code }}</td>
                                <td class="p-2">{{ $medicine->name }}</td>
                                <td class="p-2">{{ $medicine->category }}</td>
                                <td class="p-2">{{ $medicine->registered_qty }}</td>
                                <td class="p-2">{{ $medicine->sold_qty }}</td>
                                <td class="p-2">{{ $medicine->remain_qty }}</td>
                                <td class="p-2">{{ $medicine->registered_date }}</td>
                                <td class="p-2">{{ $medicine->expiry_date }}</td>
                                <td class="p-2">{{ $medicine->remark }}</td>
                                <td class="p-2">{{ $medicine->selling_price }}</td>
                                <td class="p-2">{{ $medicine->profit }}</td>
                                <td class="p-2">{{ $medicine->status }}</td>
                                <td class="p-2">
                                    <form action="{{ route('add_to_cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="medicine_id" value="{{ $medicine->id }}">
                                        <input type="number" name="quantity" min="1" value="1"
                                            class="w-16 p-1 border rounded">
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-600 text-white rounded-full">Add to Cart</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @endif

    <!-- Cart Component -->
    <x-cart :medicines="$cart"></x-cart>
</x-layout>
