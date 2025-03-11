<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
class OrderController extends Controller
{
    public function show(Order $order)
    {
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        // dd($orderItems);
        return view('order.details',compact('order','orderItems'));
    }
}
