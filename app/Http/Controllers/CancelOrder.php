<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CancelOrder extends Controller
{
    public function index()
    {
        return view('cancel.index');
    }

    public function cancelOrder(Request $request)
    {
      // retrive value sends by request

          $orderId = $request->input('order');
        //   dd($orderId);
       
        $orderItems=OrderItem::where('order_id',$orderId)->get();
        dd($orderItems[0]);
        // dd($orderItems);
        return view('cancel.index', compact('order'));
    }
}
