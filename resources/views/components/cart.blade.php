@props(['medicines' => []]) <!-- Ensure the component receives medicines as an empty array by default -->

<div class="m-5 rounded-md bg-slate-300">
    <h2 class="text-2xl p-5">Cart</h2>
    <table class="w-full border-collapse border border-gray-800">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2">Medicine</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Price per Unit</th>
                <th class="p-2">Total Price</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($medicines as $medicineId => $item)
                @if ($medicineId !== 'total_price')
                    <!-- Skip the total_price key -->
                    @php
                        $medicine = App\Models\Medicine::find($medicineId);
                    @endphp
                    <tr class="border border-x-gray-200">
                        <td class="p-2">{{ $medicine->name }}</td>
                        <td class="p-2">{{ $item['quantity'] }}</td>
                        <td class="p-2">${{ $item['selling_price'] ?? 0 }}</td>
                        <!-- Use default value if key is missing -->
                        <td class="p-2">${{ $item['total_price'] ?? 0 }}</td>
                        <!-- Use default value if key is missing -->
                        <td class="p-2">
                            <form action="{{ route('remove_from_cart', $medicineId) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white rounded-full">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="5" class="p-2 text-center">Your cart is empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Display the total price of the cart -->
    <div class="p-5 text-right">
        <h3 class="text-xl font-bold">Total Price: ${{ $medicines['total_price'] ?? 0 }}</h3>
    </div>

    @if (session()->has('cart') && count(session('cart')) > 1)
        <div class="flex justify-center">
            <a href="{{ route('completePurchase') }}"
                class="rounded-full bg-green-600 hover:bg-green-700 transition-colors text-white text-lg mb-5 shadow-sm px-4 py-2">
                اكمال عملية البيع
            </a>

        </div>
    @endif
</div>
