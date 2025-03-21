<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get query parameters
        $searchTerm = $request->query('search', '');
        $category = $request->query('category', 'all');
        $pageSize = 10; // Number of items per page

        // Start building the query
        $query = Medicine::query();

        // Apply search filter
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(code) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });
        }

        // Apply category filter
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        // Paginate the results
        $products = $query->paginate($pageSize);
        // store products in the session
        // session(['products' => $products]);

        // Fetch unique categories for the filter dropdown
        $categories = Medicine::distinct()->pluck('category');

        // Pass data to the view
        return view('products', compact('products', 'categories', 'searchTerm', 'category'));
    }
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