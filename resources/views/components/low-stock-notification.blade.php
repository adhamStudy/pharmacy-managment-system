@props(['notification' => 0, 'lowStockDetails' => []])

<div class="relative">
    <!-- Notification Icon with Badge -->
    <i class="fas fa-bell text-2xl cursor-pointer" id="notificationIcon"
        :class="{ 'text-red-500': {{ $notification }} > 0 }" title="Click for notifications"></i>

    <!-- Notification Badge -->
    @if ($notification > 0)
        <span
            class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
            {{ $notification }}
        </span>
    @endif

    <!-- Pop-up Dialog -->
    <div id="notificationPopup"
        class="fixed bg-white shadow-lg rounded-lg w-[750px] p-6 text-left mt-2 right-4 top-16 z-50 hidden border border-gray-200">
        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-lg font-semibold text-gray-700">
                <i class="fas fa-bell mr-2 text-yellow-500"></i>
                Inventory Alerts
            </h3>
            <span class="text-xs bg-red-500 text-white px-2 py-1 rounded-full">{{ count($lowStockDetails) }}
                alerts</span>
        </div>

        @if (count($lowStockDetails) > 0)
            <div class="overflow-auto max-h-[400px]">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Medicine</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Supplier</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Batch ID</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Remaining Qty</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($lowStockDetails as $batch)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $batch->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $batch->supplier->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $batch->batch_number ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span
                                        class="font-bold {{ $batch->remain_qty < 10 ? 'text-red-600' : 'text-yellow-600' }}">
                                        {{ $batch->quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $batch->remain_qty < 5 ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $batch->remain_qty < 5 ? 'Critical' : 'Low Stock' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 pt-3 border-t flex justify-between items-center">
                <span class="text-xs text-gray-500">
                    Last updated: {{ now()->setTimezone('Asia/Aden')->format('M d, Y h:i A') }}
                </span>
                <button class="text-xs text-blue-600 hover:text-blue-800 font-medium">View All Inventory
                    Reports →</button>
            </div>
        @else
            <div class="py-8 text-center">
                <i class="far fa-check-circle text-green-500 text-4xl mb-3"></i>
                <p class="text-gray-600 font-medium">All inventory levels are normal</p>
                <p class="text-xs text-gray-400 mt-1">No low stock items found</p>
            </div>
        @endif
    </div>

</div>
