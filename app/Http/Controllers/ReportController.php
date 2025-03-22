<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Order;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;
class ReportController extends Controller
{
    public function index(){
        // $products = Medicine::all();
        // dd($products);
        $sales = Order::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->orderBy('created_at', 'asc')
        ->get();
       
        $total_sales = $sales->sum('total_amount');
        // dd($total_sales);

        $selectedMonth = Carbon::now()->format('Y-m');

        return view('reports.index',compact('sales','total_sales','selectedMonth'));
    }
    public function sales(){

        $sales = Order::where('status','=','complete')->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->orderBy('created_at', 'asc')
        ->get();
        // dd($sales);
        $total_sales = $sales->sum('total_amount');
        // dd($total_sales);

        $selectedMonth = Carbon::now()->format('Y-m');
        return view('reports.sales.sales',compact('sales','total_sales','selectedMonth'));
   
}

public function salesOfMonth(Request $request)
{
    $validatedMonth = $request->validate([
        'month' => 'required|date_format:Y-m'
    ]);

    $year = date('Y', strtotime($validatedMonth['month']));  
    $month = date('m', strtotime($validatedMonth['month']));  

    $sales = Order::whereYear('created_at', $year)
                  ->whereMonth('created_at', $month)
                  ->orderBy('created_at', 'asc')
                  ->get();

    $total_sales = $sales->sum('total_amount');
    $selectedMonth = $validatedMonth['month'];

    // Return the same view with the updated values
    return view('reports.sales.sales', compact('sales', 'total_sales', 'selectedMonth'));
}

public function searchByOrderId(Request $request)
{
    // Validate query parameters
    $validatedData = $request->validate([
        'order_id' => 'required|numeric|min:1', // Validate the order ID
    ]);

    // Extract the order ID from validated data
    $orderId = $validatedData['order_id'];

    // Find the order by ID
    $sales = Order::find($orderId);

    // Check if the order exists
    if (!$sales) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    // Debug the order (optional)
    dd($sales);
    $total_sales = $sales->sum('total_amount');
    $selectedMonth = '';
    return view('reports.sales.sales', compact('sales','total_sales','selectedMonth'));


}


        public function show(Order $order)
    {
     
       
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        // dd($orderItems);
        return view('order.details',compact('order','orderItems'));
    }

    
    public function download(Order $order)
    {
        $orderItems = $order->orderItems; // Assuming a relationship
    
        // Convert QR code to base64 if available
        $qrBase64 = null;
        if ($order->qr_code) {
            $path = storage_path('app/public/qrcodes/' . basename($order->qr_code));
            if (file_exists($path)) {
                $qrBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
            }
        }
    
        $pdf = Pdf::loadView('reports.pdf_page', compact('order', 'orderItems', 'qrBase64'))
                  ->setPaper('A4', 'portrait');
    
        return $pdf->download('invoice_' . $order->id . '.pdf');
    }
    

    public function employees(){
        $users=User::all();
        // dd($users);
        return view('reports.employees');
    }
    // public function products_page(){
    //     $now = Carbon::now();

    //     // Calculate the date 3 months from now
    //     $threeMonthsFromNow = $now->copy()->addMonths(3);

    //     // Retrieve products where expiry_date is within the next 3 months
    //     $products = Medicine::where('expiry_date', '<=', $threeMonthsFromNow)
    //                         ->where('expiry_date', '>=', $now) // Ensure expiry_date is not in the past
    //                         ->paginate(10);
    //     // dd($products);
    //     return view('reports.products.products_page',compact('products'));
    // }
     
     

}