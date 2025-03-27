<x-layouts.admin>

    <h2 class="text-xl font-semibold">Medicines</h2>

    <div class="rounded-sm shadow-md p-5 bg-white mt-5">
        <x-admin.create-medicine-modal :suppliers="$suppliers" />
    </div>
</x-layouts.admin>
