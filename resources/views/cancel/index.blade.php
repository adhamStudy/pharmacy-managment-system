<x-layout>
    <div class="flex justify-center">
        <h1 class="text-3xl mt-10">This is the Cancel Page</h1>
    </div>

    <div class="mx-10">
        <form action="{{ route('cancelOrder') }}" method="GET">
            <div class="mb-4 mx-8">
                <label for="searchOrderId" class="block text-lg font-medium text-gray-700">ادخل رقم الاوردر</label>
                <input type="text" id="searchOrderId" name="order" placeholder="Enter Order ID..."
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" />

                <button type="submit" class="bg-red-500 mt-10 text-white px-4 py-2 rounded ">Search</button>
            </div>
        </form>
    </div>

    @if (isset($order))
        <div class="mt-5 text-center">
            <p><strong>Order ID:</strong> {{ $order->id }}</p>
            <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
            <p><strong>Status:</strong> {{ $order->status }}</p>
        </div>
    @endif
</x-layout>
