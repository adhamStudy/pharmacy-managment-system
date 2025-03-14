<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Order;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Payment;

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

        $sales = Order::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->orderBy('created_at', 'asc')
        ->get();
        // dd($sales);
        $total_sales = $sales->sum('total_amount');
        // dd($total_sales);

        $selectedMonth = Carbon::now()->format('Y-m');
        return view('reports.sales',compact('sales','total_sales','selectedMonth'));
   
}

    public function salesOfMonth(Request $request){
       
        $validatedMonth = $request->validate([
            'month' => 'required|date_format:Y-m'
        ]);
        // dd($validatedMonth['month']);
        $year = date('Y', strtotime($validatedMonth['month']));  // Extract year
    $month = date('m', strtotime($validatedMonth['month'])); 
    // Extract month
    // dd($month);
    $sales = Order::whereYear('created_at', $year)
                 ->whereMonth('created_at', $month)
                 ->orderBy('created_at', 'asc')
                 ->get();
                 $totalSales = $sales->sum('total_amount');
                //  dd($totalSales);
                // dd($sales);
    $selectedMonth = $request->input('month', now()->format('Y-m'));
    
         return view('reports.sales',compact('sales','selectedMonth'))->with('total_sales',$totalSales);

    }

 public function show(Order $order)
    {
        // dd($order->id);
       Order::where('id',$order->id)->update(['status'=>'complete']);
        
        // Payment::create([
        //     'order_id'=>$order->id,
        //     'amount'=>$order->total_amount,
        //     'payment_method'=>'cash',
        //     'status'=>'complete'
        // ]);
       
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        // dd($orderItems);
        return view('order.details',compact('order','orderItems'));
    }

    public function employees(){
        $users=User::all();
        // dd($users);
        return view('reports.employees');
    }
    public function products_page(){
        return view('reports.products_page');
    }
     
     

}