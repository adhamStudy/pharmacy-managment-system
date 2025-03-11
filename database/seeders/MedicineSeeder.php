<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run()
    {

        $medicines = [
            // Painkillers (20 items)
            [
                'code' => 'M001',
                'name' => 'Paracetamol',
                'category' => 'Painkiller',
                'registered_qty' => 100,
                'sold_qty' => 0,
                'remain_qty' => 100, // Updated to match registered_qty
                'registered_date' => '2023-01-01',
                'expiry_date' => '2025-01-01',
                'remark' => 'In stock',
                'selling_price' => 10.50,
                'profit' => 5.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M002',
                'name' => 'Ibuprofen',
                'category' => 'Painkiller',
                'registered_qty' => 150,
                'sold_qty' => 0,
                'remain_qty' => 150, // Updated to match registered_qty
                'registered_date' => '2023-03-10',
                'expiry_date' => '2025-03-10',
                'remark' => 'In stock',
                'selling_price' => 12.00,
                'profit' => 6.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M003',
                'name' => 'Aspirin',
                'category' => 'Painkiller',
                'registered_qty' => 200,
                'sold_qty' => 0,
                'remain_qty' => 200, // Updated to match registered_qty
                'registered_date' => '2023-04-05',
                'expiry_date' => '2025-04-05',
                'remark' => 'In stock',
                'selling_price' => 8.00,
                'profit' => 4.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M004',
                'name' => 'Naproxen',
                'category' => 'Painkiller',
                'registered_qty' => 180,
                'sold_qty' => 0,
                'remain_qty' => 180, // Updated to match registered_qty
                'registered_date' => '2023-05-12',
                'expiry_date' => '2025-05-12',
                'remark' => 'In stock',
                'selling_price' => 14.00,
                'profit' => 7.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M005',
                'name' => 'Diclofenac',
                'category' => 'Painkiller',
                'registered_qty' => 220,
                'sold_qty' => 0,
                'remain_qty' => 220, // Updated to match registered_qty
                'registered_date' => '2023-06-20',
                'expiry_date' => '2025-06-20',
                'remark' => 'In stock',
                'selling_price' => 16.00,
                'profit' => 8.00,
                'status' => 'Active'
            ],
            // Add 15 more Painkillers here...
        
            // Antibiotics (20 items)
            [
                'code' => 'M006',
                'name' => 'Amoxicillin',
                'category' => 'Antibiotic',
                'registered_qty' => 200,
                'sold_qty' => 0,
                'remain_qty' => 200, // Updated to match registered_qty
                'registered_date' => '2023-02-15',
                'expiry_date' => '2025-02-15',
                'remark' => 'In stock',
                'selling_price' => 15.00,
                'profit' => 7.50,
                'status' => 'Active'
            ],
            [
                'code' => 'M007',
                'name' => 'Ciprofloxacin',
                'category' => 'Antibiotic',
                'registered_qty' => 150,
                'sold_qty' => 0,
                'remain_qty' => 150, // Updated to match registered_qty
                'registered_date' => '2023-07-01',
                'expiry_date' => '2025-07-01',
                'remark' => 'In stock',
                'selling_price' => 20.00,
                'profit' => 10.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M008',
                'name' => 'Azithromycin',
                'category' => 'Antibiotic',
                'registered_qty' => 180,
                'sold_qty' => 0,
                'remain_qty' => 180, // Updated to match registered_qty
                'registered_date' => '2023-08-10',
                'expiry_date' => '2025-08-10',
                'remark' => 'In stock',
                'selling_price' => 18.00,
                'profit' => 9.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M009',
                'name' => 'Doxycycline',
                'category' => 'Antibiotic',
                'registered_qty' => 250,
                'sold_qty' => 0,
                'remain_qty' => 250, // Updated to match registered_qty
                'registered_date' => '2023-09-15',
                'expiry_date' => '2025-09-15',
                'remark' => 'In stock',
                'selling_price' => 22.00,
                'profit' => 11.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M010',
                'name' => 'Erythromycin',
                'category' => 'Antibiotic',
                'registered_qty' => 300,
                'sold_qty' => 0,
                'remain_qty' => 300, // Updated to match registered_qty
                'registered_date' => '2023-10-20',
                'expiry_date' => '2025-10-20',
                'remark' => 'In stock',
                'selling_price' => 25.00,
                'profit' => 12.50,
                'status' => 'Active'
            ],
            // Add 15 more Antibiotics here...
        
            // Antihistamines (20 items)
            [
                'code' => 'M011',
                'name' => 'Cetirizine',
                'category' => 'Antihistamine',
                'registered_qty' => 120,
                'sold_qty' => 0,
                'remain_qty' => 120, // Updated to match registered_qty
                'registered_date' => '2023-01-10',
                'expiry_date' => '2025-01-10',
                'remark' => 'In stock',
                'selling_price' => 5.00,
                'profit' => 2.50,
                'status' => 'Active'
            ],
            [
                'code' => 'M012',
                'name' => 'Loratadine',
                'category' => 'Antihistamine',
                'registered_qty' => 150,
                'sold_qty' => 0,
                'remain_qty' => 150, // Updated to match registered_qty
                'registered_date' => '2023-02-20',
                'expiry_date' => '2025-02-20',
                'remark' => 'In stock',
                'selling_price' => 6.00,
                'profit' => 3.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M013',
                'name' => 'Fexofenadine',
                'category' => 'Antihistamine',
                'registered_qty' => 200,
                'sold_qty' => 0,
                'remain_qty' => 200, // Updated to match registered_qty
                'registered_date' => '2023-03-30',
                'expiry_date' => '2025-03-30',
                'remark' => 'In stock',
                'selling_price' => 8.00,
                'profit' => 4.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M014',
                'name' => 'Diphenhydramine',
                'category' => 'Antihistamine',
                'registered_qty' => 180,
                'sold_qty' => 0,
                'remain_qty' => 180, // Updated to match registered_qty
                'registered_date' => '2023-04-15',
                'expiry_date' => '2025-04-15',
                'remark' => 'In stock',
                'selling_price' => 7.00,
                'profit' => 3.50,
                'status' => 'Active'
            ],
            [
                'code' => 'M015',
                'name' => 'Chlorpheniramine',
                'category' => 'Antihistamine',
                'registered_qty' => 220,
                'sold_qty' => 0,
                'remain_qty' => 220, // Updated to match registered_qty
                'registered_date' => '2023-05-25',
                'expiry_date' => '2025-05-25',
                'remark' => 'In stock',
                'selling_price' => 9.00,
                'profit' => 4.50,
                'status' => 'Active'
            ],
            // Add 15 more Antihistamines here...
        
            // Antacids (20 items)
            [
                'code' => 'M016',
                'name' => 'Omeprazole',
                'category' => 'Antacid',
                'registered_qty' => 300,
                'sold_qty' => 0,
                'remain_qty' => 300, // Updated to match registered_qty
                'registered_date' => '2023-06-01',
                'expiry_date' => '2025-06-01',
                'remark' => 'In stock',
                'selling_price' => 12.00,
                'profit' => 6.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M017',
                'name' => 'Ranitidine',
                'category' => 'Antacid',
                'registered_qty' => 250,
                'sold_qty' => 0,
                'remain_qty' => 250, // Updated to match registered_qty
                'registered_date' => '2023-07-10',
                'expiry_date' => '2025-07-10',
                'remark' => 'In stock',
                'selling_price' => 10.00,
                'profit' => 5.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M018',
                'name' => 'Esomeprazole',
                'category' => 'Antacid',
                'registered_qty' => 280,
                'sold_qty' => 0,
                'remain_qty' => 280, // Updated to match registered_qty
                'registered_date' => '2023-08-20',
                'expiry_date' => '2025-08-20',
                'remark' => 'In stock',
                'selling_price' => 14.00,
                'profit' => 7.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M019',
                'name' => 'Famotidine',
                'category' => 'Antacid',
                'registered_qty' => 320,
                'sold_qty' => 0,
                'remain_qty' => 320, // Updated to match registered_qty
                'registered_date' => '2023-09-30',
                'expiry_date' => '2025-09-30',
                'remark' => 'In stock',
                'selling_price' => 16.00,
                'profit' => 8.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M020',
                'name' => 'Calcium Carbonate',
                'category' => 'Antacid',
                'registered_qty' => 400,
                'sold_qty' => 0,
                'remain_qty' => 400, // Updated to match registered_qty
                'registered_date' => '2023-10-15',
                'expiry_date' => '2025-10-15',
                'remark' => 'In stock',
                'selling_price' => 8.00,
                'profit' => 4.00,
                'status' => 'Active'
            ],
            // Add 15 more Antacids here...
        
            // Antidepressants (20 items)
            [
                'code' => 'M021',
                'name' => 'Fluoxetine',
                'category' => 'Antidepressant',
                'registered_qty' => 150,
                'sold_qty' => 0,
                'remain_qty' => 150, // Updated to match registered_qty
                'registered_date' => '2023-01-05',
                'expiry_date' => '2025-01-05',
                'remark' => 'In stock',
                'selling_price' => 20.00,
                'profit' => 10.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M022',
                'name' => 'Sertraline',
                'category' => 'Antidepressant',
                'registered_qty' => 200,
                'sold_qty' => 0,
                'remain_qty' => 200, // Updated to match registered_qty
                'registered_date' => '2023-02-10',
                'expiry_date' => '2025-02-10',
                'remark' => 'In stock',
                'selling_price' => 22.00,
                'profit' => 11.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M023',
                'name' => 'Escitalopram',
                'category' => 'Antidepressant',
                'registered_qty' => 180,
                'sold_qty' => 0,
                'remain_qty' => 180, // Updated to match registered_qty
                'registered_date' => '2023-03-15',
                'expiry_date' => '2025-03-15',
                'remark' => 'In stock',
                'selling_price' => 24.00,
                'profit' => 12.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M024',
                'name' => 'Paroxetine',
                'category' => 'Antidepressant',
                'registered_qty' => 220,
                'sold_qty' => 0,
                'remain_qty' => 220, // Updated to match registered_qty
                'registered_date' => '2023-04-20',
                'expiry_date' => '2025-04-20',
                'remark' => 'In stock',
                'selling_price' => 26.00,
                'profit' => 13.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M025',
                'name' => 'Venlafaxine',
                'category' => 'Antidepressant',
                'registered_qty' => 250,
                'sold_qty' => 0,
                'remain_qty' => 250, // Updated to match registered_qty
                'registered_date' => '2023-05-25',
                'expiry_date' => '2025-05-25',
                'remark' => 'In stock',
                'selling_price' => 28.00,
                'profit' => 14.00,
                'status' => 'Active'
            ],
            // Add 15 more Antidepressants here...
        ];

// Continue adding medicines until you reach 100 items...

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
