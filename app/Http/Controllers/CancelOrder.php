<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MedicineBatch;
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
    DB::beginTransaction(); // Start transaction for data integrity

    try {
        $orderId = $request->input('order_id');
        $medicineId = $request->input('medicine_id');
        $cancelQty = (int) $request->input('cancel_qty');

        // Fetch the order item
        $orderItem = OrderItem::where('order_id', $orderId)
                              ->where('medicine_id', $medicineId)
                              ->first();

        if (!$orderItem || $cancelQty > $orderItem->quantity) {
            return redirect()->back()->with('error', 'Invalid cancellation request.');
        }

        // ✅ 1. Restore stock in Medicine Batches (based on expiry date)
        $remainingQtyToCancel = $cancelQty;
        $batches = MedicineBatch::where('medicine_id', $medicineId)
            ->where('sold_qty', '>', 0)
            ->orderBy('expiry_date', 'asc') // Return stock to the nearest expiry first
            ->get();

        foreach ($batches as $batch) {
            if ($remainingQtyToCancel <= 0) break;

            $restoreQty = min($batch->sold_qty, $remainingQtyToCancel);

            $batch->sold_qty -= $restoreQty;
            $batch->remain_qty += $restoreQty;
            $batch->save();

            $remainingQtyToCancel -= $restoreQty;
        }

        // ✅ 2. Update Order Items Table
        if ($orderItem->quantity == $cancelQty) {
            $orderItem->delete(); // Remove if all quantity is canceled
        } else {
            $orderItem->quantity -= $cancelQty;
            $orderItem->total = $orderItem->quantity * $orderItem->price;
            $orderItem->save();
        }

        // ✅ 3. Update Order Total
        $totalAmount = OrderItem::where('order_id', $orderId)->sum('total');
        $order = Order::find($orderId);
        $order->total_amount = $totalAmount;

        if ($totalAmount == 0) {
            $order->status = 'canceled';
        }

        $order->save();

        // ✅ 4. Update Payments Table
        $payment = Payment::where('order_id', $orderId)->first();
        if ($payment) {
            $payment->amount = $totalAmount;
            $payment->save();
        }

        DB::commit(); // Commit transaction

        return redirect()->back()->with('success', 'Medicine cancellation successful.');

    } catch (\Exception $e) {
        DB::rollBack(); // Rollback on failure
        return redirect()->back()->with('error', 'Cancellation failed: ' . $e->getMessage());
    }
}





}
