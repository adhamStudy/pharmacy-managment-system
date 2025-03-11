<x-layout>
    <div>
        <a href="{{ route('welcome') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 p-5 m-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10 18a1 1 0 01-.707-.293l-7-7a1 1 0 010-1.414l7-7a1 1 0 111.414 1.414L4.414 10H18a1 1 0 110 2H4.414l6.293 6.293A1 1 0 0110 18z"
                    clip-rule="evenodd" />
            </svg>
            Back to Welcome
        </a>
    </div>
    <div class="max-w-md mx-auto bg-white shadow-md mt-10 rounded-lg p-4 border border-gray-300">
        <h2 class="text-center text-xl font-bold mb-4">Pharmacy Invoice</h2>

        <div class="flex justify-between mb-2">
            <span class="font-semibold">Order ID:</span>
            <span>#{{ $order->id }}</span>
        </div>

        <div class="flex justify-between mb-2">
            <span class="font-semibold">Date:</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
        </div>

        <div class="flex justify-between mb-2">
            <span class="font-semibold">Cashier:</span>
            <span>{{ $order->user->name }}</span>
        </div>

        <table class="w-full border-t mt-3">
            <thead>
                <tr class="border-b">
                    <th class="text-left p-2">Medicine</th>
                    <th class="text-center p-2">Qty</th>
                    <th class="text-right p-2">Price</th>
                    <th class="text-right p-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $item)
                    <tr class="border-b">
                        <td class="p-2">{{ $item->medicine->name }}</td>
                        <td class="text-center p-2">{{ $item->quantity }}</td>
                        <td class="text-right p-2">${{ number_format($item->price, 2) }}</td>
                        <td class="text-right p-2">${{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between border-t mt-3 pt-2 font-semibold">
            <span>Total Amount:</span>
            <span>${{ number_format($orderItems->sum('total'), 2) }}</span>
        </div>

        <p class="text-center text-sm mt-3 font-bold">Thank you for your purchase!</p>
    </div>



</x-layout>
