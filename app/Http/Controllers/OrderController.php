<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
class OrderController extends Controller
{
    public function show(Order $order)
    {
        // dd($order->id);
       Order::where('id',$order->id)->update(['status'=>'complete']);
        
        Payment::create([
            'order_id'=>$order->id,
            'amount'=>$order->total_amount,
            'payment_method'=>'cash',
            'status'=>'complete'
        ]);
       
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        // dd($orderItems);
        return view('order.details',compact('order','orderItems'));
    }
}
