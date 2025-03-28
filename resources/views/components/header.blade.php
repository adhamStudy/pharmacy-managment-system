@props(['today_sales' => 0, 'username' => 'guest', 'notification' => 0, 'lowStockDetails' => []])
<div class="bg-gray-200 rounded-md shadow-md mt-10 mx-5 p-4">
    <x-header-ad />
    <div>
        <h1 class="text-xl  text-center">{{ env('CLIENT_NAME') }}</h1>
        <div class="flex justify-end ">

            <x-low-stock-notification :notification="$notification" :lowStockDetails="$lowStockDetails" />


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
