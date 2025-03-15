<x-layout>
    <div class="flex justify-center">
        <h2 class="font-bold text-red-500">Here this is Products Page</h2>
    </div>

    <div class="m-4 bg-slate-300 p-4 rounded-lg">
        <!-- Search and Category Filter Form -->
        <x-products.filter-form :searchTerm="$searchTerm" :category="$category" :categories="$categories" />

        <!-- Product Table -->
        <x-products.product-table :products="$products" />

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->appends(['search' => $searchTerm, 'category' => $category])->links() }}
        </div>
    </div>

</x-layout>
