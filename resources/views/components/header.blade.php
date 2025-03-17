@props(['today_sales' => 0, 'username' => 'guest'])
<div class="bg-gray-200 rounded-md shadow-md mt-10 mx-5 p-4">
    <x-header-ad />
    <h1 class="text-xl  text-center">Alwaleed Pharmacy</h1>

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
        <h1> Today Sales: <span class=" text-xl text-green-600">${{ $today_sales }}</span> </h1>
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
