@props(['today_sales' => 0, 'username' => 'guest', 'notification' => 0, 'lowStockBatches' => []])
<div class="bg-gray-200 rounded-md shadow-md mt-10 mx-5 p-4">
    <x-header-ad />
    <div>
        <h1 class="text-xl  text-center">{{ env('CLIENT_NAME') }}</h1>
        <div class="flex justify-end ">
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
                        <span class="text-xs bg-red-500 text-white px-2 py-1 rounded-full">{{ count($lowStockBatches) }}
                            alerts</span>
                    </div>

                    @if (count($lowStockBatches) > 0)
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
                                    @foreach ($lowStockBatches as $batch)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $batch->medicine->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $batch->medicine->supplier->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $batch->batch_number ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span
                                                    class="font-bold {{ $batch->remain_qty < 10 ? 'text-red-600' : 'text-yellow-600' }}">
                                                    {{ $batch->remain_qty }}
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
                            <span class="text-xs text-gray-500">Last updated:
                                {{ now()->format('M d, Y h:i A') }}</span>
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


        </div>
    </div>

    <div class="flex justify-between items-center">
        <div>
            <h1 class=" text-xl"> <i class="fas fa-calendar-alt text-black text-xl"></i> <span id="currentDate"></span>
            </h1>
            <h1 class=" text-xl"> <i class="fas fa-user-md text-black text-xl"></i> <!-- Doctor Icon -->
                <span>{{ $username }}</span>
            </h1>
            <h1 class="mt-5">
                <i class="fas fa-clock text-black text-xl"></i> <!-- Time Icon -->
                <span class="   text-xl text-blue-600" id="currentTime"></span>
            </h1>
        </div>


        <h1> Today Sales: <span class="text-xl text-green-600">${{ $today_sales }}</span> </h1>

        <script>
            // Get the notification icon and pop-up elements
            const notificationIcon = document.getElementById('notificationIcon');
            const notificationPopup = document.getElementById('notificationPopup');

            // Function to toggle the pop-up visibility when the icon is clicked
            notificationIcon.addEventListener('click', function() {
                notificationPopup.classList.toggle('hidden');
            });

            // Show the pop-up when mouse enters the notification icon
            notificationIcon.addEventListener('mouseenter', function() {
                notificationPopup.classList.remove('hidden');
            });

            // Hide the pop-up when mouse leaves both the icon and pop-up
            notificationIcon.addEventListener('mouseleave', function(event) {
                if (!notificationPopup.contains(event.relatedTarget)) {
                    notificationPopup.classList.add('hidden');
                }
            });

            notificationPopup.addEventListener('mouseleave', function() {
                notificationPopup.classList.add('hidden');
            });
        </script>
    </div>
</div>

<script>
    // Function to update date and time
    function updateDateTime() {
        const now = new Date();

        // Format Date (DD/MM/YYYY)
        const formattedDate = now.toLocaleDateString('en-GB');

        // Format Time (HH:MM:SS AM/PM)
        const formattedTime = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        });

        // Update DOM elements
        document.getElementById('currentDate').textContent = formattedDate;
        document.getElementById('currentTime').textContent = formattedTime;
    }

    // Run once when the page loads
    updateDateTime();

    // Update every second
    setInterval(updateDateTime, 1000);
</script>
