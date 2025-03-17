<x-layout>
    <div class="flex justify-center">
        <h1 class="text-3xl mt-10 font-bold">Cancel Order Items</h1>
    </div>

    <!-- Search Order Form -->
    <div class="mx-10">
        <form action="{{ route('cancelOrder') }}" method="GET">
            <label class="block text-lg font-medium">Enter Order ID</label>
            <input type="text" name="order" placeholder="Enter Order ID..." required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" />
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded">
                Search
            </button>
        </form>
    </div>

    <!-- Display Messages -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 mt-4 mx-10 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-3 mt-4 mx-10 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (isset($order))
        <div class="mt-5 mx-10 p-4 border border-gray-300 rounded-lg bg-gray-50 shadow-md">
            <h2 class="text-xl font-bold mb-2">Order Details</h2>
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

            <!-- Order Items Table -->
            <h2 class="text-xl font-bold mt-4">Order Items</h2>
            <table class="w-full border-collapse border border-gray-800 mt-2">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="p-2 text-center">Item Name</th>
                        <th class="p-2 text-center">Quantity</th>
                        <th class="p-2 text-center">Price per Unit</th>
                        <th class="p-2 text-center">Cancel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $item)
                        <tr class="border border-gray-200 bg-white hover:bg-gray-100">
                            <td class="p-2 text-center">{{ $item->medicine_name }}</td>
                            <td class="p-2 text-center">{{ $item->quantity }}</td>
                            <td class="p-2 text-center">${{ number_format($item->price, 2) }}</td>
                            <td class="p-2 text-center">
                                <form action="{{ route('CompleteCancelMedicine') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="medicine_id" value="{{ $item->medicine_id }}">
                                    <input type="number" name="cancel_qty" min="1" max="{{ $item->quantity }}"
                                        required class="border px-2 py-1 w-20 rounded">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded">
                                        Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>
