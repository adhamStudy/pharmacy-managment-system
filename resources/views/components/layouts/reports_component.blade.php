<x-layout x-data="{ tap: false }">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-4 text-right">التقارير</h1>

        <!-- Desktop Navigation -->
        <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px rtl:space-x-reverse">
                <li class="ms-2">
                    <a href="{{ route('sales') }}"
                        class="{{ Route::is('sales*') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }} inline-block p-4 border-b-2 rounded-t-lg">
                        تقرير المبيعات
                    </a>
                </li>
                <li class="ms-2">
                    <a href="{{ route('products_page') }}"
                        class="{{ Route::is('products_page') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }} inline-block p-4 border-b-2 rounded-t-lg">
                        تقرير المنتجات
                    </a>
                </li>
                <li class="ms-2">
                    <a href="{{ route('employees') }}"
                        class="{{ Route::is('employees') ? 'text-blue-600 border-blue-600' : 'border-transparent hover:text-gray-600 hover:border-gray-300' }} inline-block p-4 border-b-2 rounded-t-lg">
                        تقرير الموظفين
                    </a>
                </li>
            </ul>
        </div>

        <!-- Mobile Navigation -->
        <div class="sm:hidden w-full text-right mt-4">
            <select id="mobile-tabs" onchange="window.location.href=this.value"
                class="p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-gray-700 text-sm w-48">
                <option value="{{ route('sales') }}" {{ Route::is('sales*') ? 'selected' : '' }}>تقرير المبيعات</option>
                <option value="{{ route('products_page') }}" {{ Route::is('products_page') ? 'selected' : '' }}>تقرير
                    المنتجات</option>
                <option value="{{ route('employees') }}" {{ Route::is('employees') ? 'selected' : '' }}>تقرير الموظفين
                </option>
            </select>
        </div>
    </div>

    {{ $slot }}
</x-layout>
