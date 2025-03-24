<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('carts')->truncate();
    DB::table('orders')->truncate();
    DB::table('medicines')->truncate();
    DB::table('order_items')->truncate();
    DB::table('payments')->truncate();

    // // Seed only the medicines
    $this->call(MedicineSeeder::class);
    $this->call(MedicineBatchSeeder::class);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
