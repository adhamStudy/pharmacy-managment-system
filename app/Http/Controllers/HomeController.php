<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\MedicineBatch;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Carbon\Carbon;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // Initial load of the welcome page
    public function index(Request $request)
{
    // Check if the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $user = Auth::user();

    // Check if the user is inactive
    if (!$user->active) {
        Auth::logout();
        return redirect()->route('login')->withErrors(['inactive' => 'Your account has been deactivated.']);
    }

    // Retrieve the search query from the URL (if it exists)
    $search = $request->query('search');
    
    // Perform the search if a query is provided
    $medicines = [];

    // $lowStockBatches = MedicineBatch::with(['medicine.supplier'])
    // ->where('remain_qty', '<', 10)
    // ->get();

    // $notification = $lowStockBatches->count();
    $lowStockMedicines = MedicineBatch::selectRaw('
    medicine_id, 
    SUM(remain_qty) as total_qty
                        ')
    ->where('status', 'active') // Only active batches
    ->groupBy('medicine_id') // Group by medicine
    ->havingRaw('SUM(remain_qty) < 10') // Only medicines with total stock below 10
    ->pluck('medicine_id'); // Get medicine IDs

    // Fetch medicine details along with supplier info
    $lowStockDetails = Medicine::whereIn('id', $lowStockMedicines)
    ->with('supplier') // Eager load supplier info
    ->get(['id', 'name', 'supplier_id']); // Fetch only necessary columns

    // Add quantity data manually
    $lowStockDetails = $lowStockDetails->map(function ($medicine) {
    $medicine->quantity = MedicineBatch::where('medicine_id', $medicine->id)
        ->where('status', 'active') // Only active batches
        ->sum('remain_qty'); // Sum remaining quantities
    return $medicine;
    });
    // dd($lowStockDetails->toArray());
    $notification= $lowStockDetails->count();

    
    
    if ($search) {
        $medicines = Medicine::where('name', 'ILIKE', "%".$search."%")
            ->with(['batches' => function ($query) {
                // Filter batches to include only active ones
                $query->where('status', 'active')
                      ->where('expiry_date', '>', Carbon::now()) // Exclude expired batches
                      ->orderBy('remain_qty', 'desc') // Order by remaining quantity
                      ->first(); // Get the batch with the most remaining quantity
            }])
            ->get();
    }

    // Retrieve the cart from the session (if it exists)
    $cart = session()->get('cart', []);

    $username = Auth::user()->name;

    $today_sales = Payment::whereHas('order', function ($query) {
        $query->where('user_id', Auth::id());
    })
    ->whereDate('created_at', Carbon::today())
    ->sum('amount');

    // Pass the results and cart to the view
    return view('welcome', compact('medicines', 'search', 'cart', 'today_sales', 'username','notification','lowStockDetails'));
}

    // Handle search form submission
    public function search(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'search' => 'required|string|max:255',
        ]);

        // Get the search query
        $search = $request->input('search');

        // Redirect to the welcome page with the search query as a URL parameter
        return redirect()->route('welcome', ['search' => $search]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $medicineId = $request->input('medicine_id');
        $quantityNeeded = $request->input('quantity');
    
        // Get available batches for this medicine, sorted by expiry date (FIFO)
        $batches = MedicineBatch::where('medicine_id', $medicineId)
            ->where('remain_qty', '>', 0) // Only batches with stock
            ->where('status', 'active') // Only active batches
            ->where('expiry_date', '>', Carbon::now()) // Exclude expired batches
            ->orderBy('expiry_date', 'asc') // FIFO: earliest expiry first
            ->get();
    
        if ($batches->isEmpty()) {
            return back()->with('error', "No available stock for this medicine.");
        }
    
        $cart = session()->get('cart', []);
    
        $remainingQuantity = $quantityNeeded;
        $totalItemPrice = 0;
    
        foreach ($batches as $batch) {
            if ($remainingQuantity <= 0) break; // Stop if we've added all needed quantity
    
            // Determine how much we can take from this batch
            $batchQtyToTake = min($batch->remain_qty, $remainingQuantity);
            $remainingQuantity -= $batchQtyToTake;
    
            $cartKey = $medicineId . '_' . $batch->id;
    
            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $batchQtyToTake;
                $cart[$cartKey]['total_price'] += $batch->selling_price * $batchQtyToTake;
            } else {
                $cart[$cartKey] = [
                    'medicine_id' => $medicineId,
                    'batch_id' => $batch->id,
                    'quantity' => $batchQtyToTake,
                    'total_price' => $batch->selling_price * $batchQtyToTake,
                    'selling_price' => $batch->selling_price,
                    'medicine_name' => $batch->medicine->name,
                    'batch_code' => $batch->batch_code,
                    'expiry_date' => $batch->expiry_date,
                    'status' => $batch->status, // Add status to cart data
                ];
            }
    
            $totalItemPrice += $batch->selling_price * $batchQtyToTake;
        }
    
        if ($remainingQuantity > 0) {
            return back()->with('error', "Not enough stock available. Only " . ($quantityNeeded - $remainingQuantity) . " could be added.");
        }
    
        // Update total cart price
        $cart['total_price'] = array_sum(array_column($cart, 'total_price'));
    
        session()->put('cart', $cart);
    
        return redirect()->route('welcome')->with('success', 'Medicine added to cart successfully!');
    }
    
    
    public function removeFromCart($cartKey)
{
    // Retrieve the cart from the session
    $cart = session()->get('cart', []);

    // Remove the medicine from the cart and subtract its total price
    if (isset($cart[$cartKey])) {
        $cart['total_price'] -= $cart[$cartKey]['total_price'];
        unset($cart[$cartKey]);
    }

    // Store the updated cart in the session
    session()->put('cart', $cart);

    // Redirect back to the welcome page with a success message
    return redirect()->route('welcome')->with('success', 'Medicine removed from cart successfully!');
}

    public function completePurchase()
    {
        $cart = session()->get('cart', []);
    
        // Check if user is authenticated or cart is empty
        if (!Auth::check() || empty($cart)) {
            return redirect()->route('welcome')->with('error', 'User not authorized or cart is empty.');
        }
    
        // Validate stock availability
        foreach ($cart as $cartKey => $item) {
            if ($cartKey !== 'total_price') {
                $medicineBatch = MedicineBatch::findOrFail($item['batch_id']);
    
                if ($item['quantity'] > $medicineBatch->remain_qty) {
                    return redirect()->route('welcome')->with('error', "Not enough stock for {$item['medicine_name']} (Batch: {$item['batch_code']}). Available: {$medicineBatch->remain_qty}.");
                }
            }
        }
    
        // Create the order
        $order = Order::create([
            'total_amount' => $cart['total_price'],
            'status' => 'pending',
            'user_id' => Auth::id()
        ]);
    
        // Create order items and update stock
        foreach ($cart as $cartKey => $item) {
            if ($cartKey !== 'total_price') {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $item['medicine_id'],
                    'batch_id' => $item['batch_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['selling_price'],
                    'total' => $item['total_price']
                ]);
    
                // Update batch stock
                $medicineBatch = MedicineBatch::findOrFail($item['batch_id']);
                $medicineBatch->decrement('remain_qty', $item['quantity']);
                $medicineBatch->increment('sold_qty', $item['quantity']);
            }
        }
    
        // Generate QR code with only the Order ID
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data((string)$order->id)
            ->encoding(new Encoding('UTF-8'))
            ->size(200)
            ->errorCorrectionLevel(ErrorCorrectionLevel::High)
            ->build();
    
        // Save QR code as file
        $qrCodePath = 'qrcodes/order_' . $order->id . '.png';
        Storage::disk('public')->put($qrCodePath, $qrCode->getString());
    
        // Save QR code path in database
        $order->update(['qr_code' => $qrCodePath]);
    
        // Clear the cart
        session()->forget('cart');
    
        // Redirect to order details page
        return redirect()->route('order.details', ['order' => $order->id])
            ->with('success', 'Purchase completed successfully!');
    }
}