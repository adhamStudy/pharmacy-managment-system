<x-reports.reports-layout>
    <div class="mt-10 mb-10">
        <form action="{{ route('salesOfMonth') }}" class="flex gap-7 mx-10">
            <label for="name"> المنتجااااااات </label>
            <input type="month" id="month" name="month">
            <button class="bg-green-600 text-white text-xl rounded-md shadow-sm px-2 py-1" type="submit">
                Search</button>

        </form>
    </div>
    {{-- <x-reports.sales-table :sales="$sales" :total_sales="$total_sales" :selectedMonth="$selectedMonth" /> --}}


</x-reports.reports-layout>
