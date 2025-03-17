<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Medicine;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
class CancelOrder extends Controller
{
    public function index()
    {
        return view('cancel.index');
    }

    public function cancelOrder(Request $request)
{
    // Retrieve the order ID from the request
    $orderId = $request->input('order');

    // Check if the order exists with its items
    $order = Order::with('orderItems')->find($orderId);

    if (!$order) {
        return view('cancel.index')->with('error', 'Order not found.');
    }

    // Retrieve the order items
    $orderItems = DB::table('order_items')
    ->join('medicines', 'order_items.medicine_id', '=', 'medicines.id')
    ->where('order_items.order_id', $orderId)
    ->select('order_items.*', 'medicines.name as medicine_name')
    ->get();

    // dd($orderItems);
    return view('cancel.index', compact('order', 'orderItems'));
}
public function CompleteCancelMedicine(Request $request)
{
    $orderId = $request->input('order_id'); // Fixed input name
    $medicineId = $request->input('medicine_id');
    $cancelQty = (int) $request->input('cancel_qty'); // Ensure integer conversion

    // Check if the order and medicine exist in order_items
    $orderItem = OrderItem::where('order_id', $orderId)
                          ->where('medicine_id', $medicineId)
                          ->first();

    if (!$orderItem || $cancelQty > $orderItem->quantity) {
        return redirect()->back()->with('error', 'Invalid cancellation request.');
    }

    // Update medicines table
    $medicine = Medicine::find($medicineId);
    $medicine->sold_qty -= $cancelQty;
    $medicine->remain_qty += $cancelQty; // Optional: If returning to stock
    $medicine->save();

    // Update order_items table
    if ($orderItem->quantity == $cancelQty) {
        $orderItem->delete(); // Remove the item if all quantity is canceled
    } else {
        $orderItem->quantity -= $cancelQty;
        $orderItem->total = $orderItem->quantity * $orderItem->price; // ✅ Update total field
        $orderItem->save();
    }

    // Update total_amount in orders table
    $totalAmount = OrderItem::where('order_id', $orderId)
                            ->sum('total'); // ✅ Use the sum of the 'total' column

    $order = Order::find($orderId);
    $order->total_amount = $totalAmount;

    // Optional: Cancel order if no items left
    if ($totalAmount == 0) {
        $order->status = 'canceled';
    }
    
    $order->save();

    // ✅ Update Payment Table
    $payment = Payment::where('order_id', $orderId)->first();
    if ($payment) {
        $payment->amount = $totalAmount;
        $payment->save();
    }
    $order = Order::with('orderItems')->find($orderId);
    $orderItems = DB::table('order_items')
    ->join('medicines', 'order_items.medicine_id', '=', 'medicines.id')
    ->where('order_items.order_id', $orderId)
    ->select('order_items.*', 'medicines.name as medicine_name')
    ->get();
    return view('cancel.index', compact('order', 'orderItems'))
                     ->with('success', 'Medicine canceled successfully.');
}




}
