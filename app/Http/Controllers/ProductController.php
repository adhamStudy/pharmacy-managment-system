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
    public function productsExpireDate3Month(){
        $now = Carbon::now();

        // Calculate the date 3 months from now
        $threeMonthsFromNow = $now->copy()->addMonths(3);

        // Retrieve products where expiry_date is within the next 3 months
        $products = Medicine::where('expiry_date', '<=', $threeMonthsFromNow)
                            ->where('expiry_date', '>=', $now) // Ensure expiry_date is not in the past
                            ->paginate(10);
        // dd($products);
        return view('reports.products.products_page',compact('products'));
    }

    
    
}