@props(['medicines' => []]) <!-- Ensure the component receives medicines as an empty array by default -->
<div class="m-5 rounded-md bg-slate-300">
    <h2 class="text-2xl p-5">Cart</h2>
    <table class="w-full border-collapse border border-gray-800">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-2">Medicine</th>
                <th class="p-2">Batch</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Price per Unit</th>
                <th class="p-2">Total Price</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cart = session('cart', []);
            @endphp
            @forelse ($cart as $cartKey => $item)
                @if ($cartKey !== 'total_price')
                    <tr class="border border-x-gray-200">
                        <td class="p-2">{{ $item['medicine_name'] }}</td>
                        <td class="p-2">{{ $item['batch_code'] }}</td>
                        <td class="p-2">{{ $item['quantity'] }}</td>
                        <td class="p-2">${{ number_format($item['selling_price'], 2) }}</td>
                        <td class="p-2">${{ number_format($item['total_price'], 2) }}</td>
                        <td class="p-2">
                            <form action="{{ route('remove_from_cart', $cartKey) }}" method="POST">
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
                    <td colspan="6" class="p-2 text-center">Your cart is empty.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Display the total price of the cart -->
    <div class="p-5 text-right">
        <h3 class="text-xl font-bold">Total Price: ${{ number_format($cart['total_price'] ?? 0, 2) }}</h3>
    </div>

    @if (!empty($cart) && count($cart) > 1)
        <div class="flex justify-center pb-5">
            <a href="{{ route('completePurchase') }}"
                class="rounded-full bg-green-600 hover:bg-green-700 transition-colors text-white text-lg shadow-sm px-4 py-2">
                Complete Purchase
            </a>
        </div>
    @endif
</div>
