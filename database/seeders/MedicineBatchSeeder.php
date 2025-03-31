<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MedicineBatch;
use App\Models\Medicine;
use Carbon\Carbon;

class MedicineBatchSeeder extends Seeder
{
    public function run()
    {
        $medicines = Medicine::all();
        $batches = [];
        $batchCountMultiplier = 5; // Increase to generate more batches per medicine

        foreach ($medicines as $medicine) {
            $batchCount = rand(3, 5) * $batchCountMultiplier; // Generate more batches per medicine

            for ($i = 0; $i < $batchCount; $i++) {
                $registeredDate = Carbon::now()->subMonths(rand(1, 24));
                $expiryDate = $registeredDate->copy()->addYears(2);
                $registeredQty = rand(100, 1000); // Increase registered quantity range
                $soldQty = rand(0, $registeredQty);
                $remainQty = $registeredQty - $soldQty;

                $currentDate = Carbon::now();
                $oneMonthBeforeExpiry = $expiryDate->copy()->subMonth();

                $status = ($expiryDate->isPast() || $currentDate->gte($oneMonthBeforeExpiry)) ? 'passive' : 'active';

                $batches[] = [
                    'medicine_id' => $medicine->id,
                    'batch_code' => $medicine->code . '-B' . ($i + 1),
                    'registered_qty' => $registeredQty,
                    'sold_qty' => $soldQty,
                    'remain_qty' => $remainQty,
                    'registered_date' => $registeredDate->format('Y-m-d'),
                    'expiry_date' => $expiryDate->format('Y-m-d'),
                    'selling_price' => rand(50, 500) / 10,
                    'profit' => rand(10, 200) / 10,
                    'remark' => $remainQty > 0 ? ($remainQty < 50 ? 'Low stock' : 'In stock') : 'Out of stock',
                    'status' => $status,
                ];
            }
        }

        // Bulk insert to improve performance
        foreach (array_chunk($batches, 1000) as $chunk) { // Increase chunk size
            MedicineBatch::insert($chunk);
        }
    }
}