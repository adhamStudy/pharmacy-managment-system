<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;
use Faker\Factory as Faker;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $categories = ['Painkiller', 'Antibiotic', 'Antihistamine', 'Cardiovascular', 'Diabetes', 'Vitamin', 'Antifungal', 'Antiviral'];
        $baseCode = 'M';
        $numMedicines = 1000; // Adjust this number for the desired size of your dataset

        for ($i = 1; $i <= $numMedicines; $i++) {
            $code = $baseCode . str_pad($i, 4, '0', STR_PAD_LEFT);
            $name = ucfirst($faker->word) . ' ' . ucfirst($faker->word); // Generates a random name
            $category = $faker->randomElement($categories);
            $supplierId = rand(1, 10);

            Medicine::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $name,
                    'category' => $category,
                    'supplier_id' => $supplierId,
                ]
            );
        }
    }
}