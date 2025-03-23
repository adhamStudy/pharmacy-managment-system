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
        
        foreach ($medicines as $medicine) {
            // Generate multiple batches for each medicine
            $batchCount = rand(1, 3); // 1-3 batches per medicine
            
            for ($i = 0; $i < $batchCount; $i++) {
                $registeredDate = Carbon::now()->subMonths(rand(1, 24));
                $expiryDate = $registeredDate->copy()->addYears(2);
                
                // $registeredQty = rand(50, 500);
                // $soldQty = rand(0, $registeredQty);
                // $remainQty = $registeredQty - $soldQty;

                 $registeredQty = 100;
                 $soldQty = 0;
                 $remainQty = $registeredQty - $soldQty;


                // Determine status based on expiry_date
                $currentDate = Carbon::now();
                $oneMonthBeforeExpiry = $expiryDate->copy()->subMonth();

                if ($expiryDate->isPast() || $currentDate->gte($oneMonthBeforeExpiry)) {
                    $status = 'passive'; // Expired or within 1 month of expiry
                } else {
                    $status = 'active'; // Not expired and more than 1 month remaining
                }
                
                $batches[] = [
                    'medicine_id' => $medicine->id,
                    'batch_code' => $medicine->code . '-B' . ($i + 1),
                    'registered_qty' => $registeredQty,
                    'sold_qty' => $soldQty,
                    'remain_qty' => $remainQty,
                    'registered_date' => $registeredDate->format('Y-m-d'),
                    'expiry_date' => $expiryDate->format('Y-m-d'),
                    'selling_price' => rand(50, 500) / 10, // Random price between 5.0 and 50.0
                    'profit' => rand(10, 200) / 10, // Random profit between 1.0 and 20.0
                    'remark' => $remainQty > 0 ? 
                        ($remainQty < 50 ? 'Low stock' : 'In stock') : 
                        'Out of stock',
                    'status' => $status // Add status field based on expiry_date
                ];
            }
        }

        // Bulk insert to improve performance
        foreach (array_chunk($batches, 100) as $chunk) {
            MedicineBatch::insert($chunk);
        }
    }
}