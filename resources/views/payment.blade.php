<x-layout>
    <div>
        <a href="{{ route('welcome') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a1 1 0 01-.707-.293l-7-7a1 1 0 010-1.414l7-7a1 1 0 111.414 1.414L4.414 10H18a1 1 0 110 2H4.414l6.293 6.293A1 1 0 0110 18z"
                    clip-rule="evenodd" />
            </svg>
            Back to Welcome
        </a>
    </div>
    <div class="max-w-sm mx-auto bg-white p-4 rounded-lg shadow-md border border-gray-300 text-sm">
        <!-- Pharmacy Header -->
        <div class="text-center mb-2">
            <h1 class="text-lg font-bold text-gray-800">Your Pharmacy</h1>
            <p class="text-gray-600">123 Main Street, City</p>
            <p class="text-gray-600">Phone: (123) 456-7890</p>
        </div>

        <hr class="border-gray-400 my-2">

        <!-- Invoice Details -->
        <div class="text-xs">
            <p><strong>Invoice #:</strong> {{ strtoupper(Str::random(8)) }}</p>
            <p><strong>Date:</strong> {{ now()->format('Y-m-d H:i:s') }}</p>
            <p><strong>Cashier:</strong> {{ Auth::user()->name }}</p> <!-- Dynamic Cashier Name -->
        </div>

        <hr class="border-gray-400 my-2">

        <!-- Invoice Table -->
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b border-gray-400">
                    <th class="text-left">Item</th>
                    <th class="text-center">Qty</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cart = session('cart', []);
                    $totalAmount = $cart['total_price'] ?? 0;
                    unset($cart['total_price']); // Remove total price from list
                @endphp

                @foreach ($cart as $item)
                    <tr class="border-b border-gray-300">
                        <td class="text-left">{{ $item['medicine_name'] ?? 'Unknown' }}</td>
                        <td class="text-center">{{ $item['quantity'] }}</td>
                        <td class="text-right">${{ number_format($item['selling_price'], 2) }}</td>
                        <td class="text-right">${{ number_format($item['total_price'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr class="border-gray-400 my-2">

        <!-- Summary -->
        <div class="text-xs">
            <p class="flex justify-between"><strong>Subtotal:</strong>
                <span>${{ number_format($totalAmount, 2) }}</span>
            </p>
            <p class="flex justify-between"><strong>VAT (5%):</strong>
                <span>${{ number_format($totalAmount * 0.05, 2) }}</span>
            </p>
            <p class="flex justify-between text-lg font-bold"><strong>Total:</strong>
                <span>${{ number_format($totalAmount * 1.05, 2) }}</span>
            </p>
        </div>

        <hr class="border-gray-400 my-2">

        <!-- Footer -->
        <div class="text-center text-xs">
            <p>Thank you for your purchase!</p>
            <p class="text-gray-500">Visit us again.</p>
        </div>

        <!-- Print Button -->
        <div class="text-center mt-3">
            <button onclick="window.print()" class="bg-blue-600 text-white px-3 py-1 rounded text-xs">
                Print Receipt
            </button>
        </div>
    </div>
</x-layout>
