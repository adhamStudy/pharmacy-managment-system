<x-reports.reports-layout>
    <div class="mx-5">
        <h1 class="my-2 text-xl">منتجات قريبة الانتهاء</h1>
        <x-reports.products-with-filter :batches="$batches" />
    </div>
</x-reports.reports-layout>
