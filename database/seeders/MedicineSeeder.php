<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $medicines = [
            [
                'code' => 'M001',
                'name' => 'Paracetamol',
                'category' => 'Painkiller',
                'registered_qty' => 100,
                'sold_qty' => 50,
                'remain_qty' => 50,
                'registered_date' => '2023-01-01',
                'expiry_date' => '2025-01-01',
                'remark' => 'In stock',
                'selling_price' => 10.50,
                'profit' => 5.00,
                'status' => 'Active'
            ],
            [
                'code' => 'M002',
                'name' => 'Amoxicillin',
                'category' => 'Antibiotic',
                'registered_qty' => 200,
                'sold_qty' => 75,
                'remain_qty' => 125,
                'registered_date' => '2023-02-15',
                'expiry_date' => '2025-02-15',
                'remark' => 'Low stock',
                'selling_price' => 15.00,
                'profit' => 7.50,
                'status' => 'Active'
            ],
            [
                'code' => 'M003',
                'name' => 'Ibuprofen',
                'category' => 'Painkiller',
                'registered_qty' => 150,
                'sold_qty' => 100,
                'remain_qty' => 50,
                'registered_date' => '2023-03-10',
                'expiry_date' => '2025-03-10',
                'remark' => 'In stock',
                'selling_price' => 12.00,
                'profit' => 6.00,
                'status' => 'Active'
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
