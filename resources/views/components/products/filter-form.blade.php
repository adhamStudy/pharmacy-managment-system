<form action="{{ route('products') }}" method="GET" class="mb-4">
    <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
        <!-- Search Input -->
        <input type="text" name="search" placeholder="Search by product name or code" value="{{ $searchTerm }}"
            class="w-full p-0.5 rounded-md bg-white shadow-sm focus:ring-2 focus:ring-blue-500">

        <!-- Category Dropdown -->
        <select name="category" class="w-full p-0.5 rounded-md bg-white shadow-sm focus:ring-2 focus:ring-blue-500">
            <option value="all">Show All</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>
                    {{ $cat }}
                </option>
            @endforeach
        </select>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full md:w-auto px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
            Filter
        </button>
    </div>
</form>
