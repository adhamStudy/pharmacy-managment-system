<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
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
    
// $medicine->toArray());
    // $searchTerm = $request->query('search', '');
    // $category = $request->query('category', 'all');
    // $pageSize = 10;

    // // Start Query
    // $query = Medicine::with('batches'); // Don't call get() here

    // // Apply search filter
    // if ($searchTerm) {
    //     $query->where(function ($q) use ($searchTerm) {
    //         $q->where('name', 'ILIKE', "%{$searchTerm}%")
    //           ->orWhere('code', 'ILIKE', "%{$searchTerm}%");
    //     });
    // }

    // // Apply category filter
    // if ($category !== 'all') {
    //     $query->where('category', $category);
    // }

    // // Paginate results
    // $products = $query->with('batches')->get(); // Call paginate() instead of get()
    // // dd($products);
    // // Fetch unique categories
    // $categories = Medicine::distinct()->pluck('category');
    // // dd($categories);
    // return view('products', compact('products', 'categories', 'searchTerm', 'category'));
// }


    

    public function productsExpireDate3Month(Request $request) {
        $now = Carbon::now()->startOfDay();
        $threeMonthsFromNow = $now->copy()->addMonths(3);
    
        // Get search query
        $search = $request->input('search');
    
        // Query builder
        $query = Medicine::whereBetween('expiry_date', [$now, $threeMonthsFromNow]);
    
        // Apply search if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('code', 'LIKE', "%$search%")
                  ->orWhere('name', 'LIKE', "%$search%");
            });
        }
    
        // Order by days remaining (expiry_date ascending)
        $products = $query->orderBy('expiry_date', 'asc')
            ->paginate(2)
            ->appends(['search' => $search]);
    
        // Add "days_remaining" field to each product
        $products->getCollection()->transform(function ($product) use ($now) {
            // Calculate days remaining (positive value)
            $product->days_remaining = $now->startOfDay()->diffInDays(Carbon::parse($product->expiry_date)->startOfDay(), false);
            return $product;
        });
    
        return view('reports.products.products_page', compact('products', 'search'));
    }
    
    
    

    
    
}