@props(['suppliers' => []])

<div x-data="{
    medicines: JSON.parse(localStorage.getItem('medicines')) || [],
    showTable: false,
    editIndex: null,
    currentMedicine: {
        supplier_id: '',
        name: '',
        category: '',
        registered_qty: '',
        expiry_date: '',
        selling_price: '',
        profit: ''
    },
    formatDate(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    },
    resetForm() {
        this.currentMedicine = {
            supplier_id: '',
            name: '',
            category: '',
            registered_qty: '',
            expiry_date: '',
            selling_price: '',
            profit: ''
        };
        this.editIndex = null;
    },
    saveMedicines() {
        localStorage.setItem('medicines', JSON.stringify(this.medicines));
    },
    addMedicine(e) {
        e.preventDefault();
        if (this.editIndex !== null) {
            this.medicines[this.editIndex] = { ...this.currentMedicine };
            this.editIndex = null;
        } else {
            this.medicines.push({ ...this.currentMedicine });
        }
        this.saveMedicines();
        this.resetForm();
    },
    editMedicine(index) {
        this.currentMedicine = { ...this.medicines[index] };
        this.editIndex = index;
        this.showTable = false;
    },
    deleteMedicine(index) {
        this.medicines.splice(index, 1);
        this.saveMedicines();
    },
    clearIfSuccess() {
        @if (session('success')) localStorage.removeItem('medicines');
            this.medicines = []; @endif
    }
}" x-init="clearIfSuccess()" class="mx-auto bg-white p-6 rounded-lg shadow-md max-w-5xl">



    <template x-if="!showTable">
        <!-- Previous form code remains the same -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-6"
                x-text="editIndex !== null ? 'Edit Medicine' : 'Create Medicine'"></h2>

            <form @submit="addMedicine">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Supplier Selection --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Supplier</label>
                        <select x-model="currentMedicine.supplier_id"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Medicine Name --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Medicine Name</label>
                        <input type="text" x-model="currentMedicine.name"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Category</label>
                        <select x-model="currentMedicine.category"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                            <option value="" disabled>Select a category</option>
                            <option value="Analgesics">Analgesics</option>
                            <option value="Antibiotics">Antibiotics</option>
                            <option value="Antidepressants">Antidepressants</option>
                            <option value="Antihistamines">Antihistamines</option>
                            <option value="Cardiovascular Drugs">Cardiovascular Drugs</option>
                            <option value="Diuretics">Diuretics</option>
                            <option value="Hormonal Drugs">Hormonal Drugs</option>
                            <option value="Immunosuppressants">Immunosuppressants</option>
                            <option value="Respiratory Drugs">Respiratory Drugs</option>
                            <option value="Vaccines">Vaccines</option>
                        </select>
                    </div>


                    {{-- Registered Quantity --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Registered Quantity</label>
                        <input type="number" x-model="currentMedicine.registered_qty"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300"
                            min="1" required>
                    </div>

                    {{-- Expiry Date --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Expiry Date</label>
                        <input type="date" x-model="currentMedicine.expiry_date"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300" required>
                    </div>

                    {{-- Selling Price --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Selling Price</label>
                        <input type="number" x-model="currentMedicine.selling_price"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300"
                            step="0.01" min="0" required>
                    </div>

                    {{-- Profit --}}
                    <div>
                        <label class="block text-gray-700 font-medium">Profit</label>
                        <input type="number" x-model="currentMedicine.profit"
                            class="w-full p-2 border border-gray-300 rounded focus:ring focus:ring-blue-300"
                            step="0.01" min="0" required>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        <span x-text="editIndex !== null ? 'Update Medicine' : 'Add Medicine'"></span>
                    </button>
                    <button type="button" @click="showTable = true" x-show="medicines.length > 0"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Review Medicines
                    </button>
                </div>
            </form>
        </div>
    </template>

    <template x-if="showTable">
        <div>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Medicines to Add</h2>
                <button @click="showTable = false"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Add More
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Expiry Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template x-for="(medicine, index) in medicines" :key="index">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap" x-text="medicine.name"></td>
                                <td class="px-6 py-4 whitespace-nowrap" x-text="medicine.category"></td>
                                <td class="px-6 py-4 whitespace-nowrap" x-text="medicine.registered_qty"></td>
                                <td class="px-6 py-4 whitespace-nowrap" x-text="'$' + medicine.selling_price"></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        x-text="formatDate(medicine.expiry_date)"></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex gap-2">
                                        <button @click="editMedicine(index)" class="text-blue-600 hover:text-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteMedicine(index)" class="text-red-600 hover:text-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <form action="{{ route('admin.storeMedicine') }}" method="POST" x-show="medicines.length > 0"
                class="mt-6">
                @csrf
                <template x-for="medicine in medicines" :key="medicine.name">
                    <input type="hidden" :name="'medicines[]'" :value="JSON.stringify(medicine)">
                </template>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                        Submit All Medicines
                    </button>
                </div>
            </form>
        </div>
    </template>
</div>
