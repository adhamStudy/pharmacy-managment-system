<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\MedicineBatch;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get filters from request
        $search = $request->input('search');
        $category = $request->input('category');
    
        // Query with filters
        $query = Medicine::with(['batches' => function ($q) {
            $q->orderBy('expiry_date', 'asc'); // Order batches by nearest expiry date
        }]);
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('code', 'LIKE', "%{$search}%");
            });
        }
    
        if ($category) {
            $query->where('category', $category);
        }
    
        // Paginate the results (10 per page)
        $medicines = $query->paginate(10);
    
        // Fetch unique categories for the filter dropdown
        $categories = Medicine::select('category')->distinct()->pluck('category');
    
        return view('products', compact('medicines', 'categories', 'search', 'category'));
    }
    



    

    public function productsExpireDate3Month(Request $request) {
        $now = Carbon::now()->startOfDay();
        $threeMonthsFromNow = $now->copy()->addMonths(3);
    
        // Get search query
        $search = $request->input('search');
    
        // Query builder for MedicineBatch (since expiry_date is in this table)
        $query = MedicineBatch::whereBetween('expiry_date', [$now, $threeMonthsFromNow])
                    ->with('medicine'); // Ensure we load related Medicine data
    
        // Apply search filter on Medicine table (name or code)
        if ($search) {
            $query->whereHas('medicine', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('code', 'LIKE', "%$search%");
            });
        }
    
        // Order by expiry_date (earliest expiring first)
        $batches = $query->orderBy('expiry_date', 'asc')
            ->paginate(10)
            ->appends(['search' => $search]);
    
        // Add "days_remaining" field to each batch
        $batches->getCollection()->transform(function ($batch) use ($now) {
            $batch->days_remaining = $now->diffInDays(Carbon::parse($batch->expiry_date), false);
            return $batch;
        });
    
        return view('reports.products.products_page', compact('batches', 'search'));
    }
    
    
    

    
    
}