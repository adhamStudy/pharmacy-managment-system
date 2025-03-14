<x-layout x-data="{ tap: false }">
    <div>
        <h1 class="text-2xl text-red-500">This is reports page</h1>
        <div class="flex my-5 justify-center gap-7">
            <a class="bg-gray-200 py-2 px-4  rounded-sm shadow-sm" href="{{ route('sales') }}">تقرير المبيعات </a>
            <a class="bg-gray-200 py-2 px-4 rounded-sm shadow-sm" href="{{ route('products_page') }}">تقرير المنتجات </a>
            <a class="bg-gray-200 py-2 px-4 rounded-sm shadow-sm" href="{{ route('employees') }}">تقرير الموظفين </a>
        </div>
    </div>
    {{ $slot }}
</x-layout>
