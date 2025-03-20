<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        if ($search) {
            $medicines = Medicine::where('name', 'ILIKE', "%".$search."%")->get();
            // dd($medicines);
        }

        // Retrieve the cart from the session (if it exists)
        $cart = session()->get('cart', []);

        $username = Auth::user()->name;
                // dd($username);

        // Join 
        $today_sales = Payment::whereHas('order', function ($query) {
            $query->where('user_id', Auth::id()); // Filter orders by logged-in user
        })
        ->whereDate('created_at', Carbon::today()) // Filter by today's date
        ->sum('amount');
            // dd($today_sales);
        // Pass the results and cart to the view
        return view('welcome', compact('medicines', 'search', 'cart','today_sales','username'));
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
            $quantity = $request->input('quantity');
            $medicine = Medicine::find($medicineId);
        
            // Check if the medicine exists
            if (!$medicine) {
                return back()->with('error', 'Medicine not found.');
            }
        
            // Check if the requested quantity exceeds the available stock
            if ($quantity > $medicine->remain_qty) {
                return back()->with('error', "Not enough stock for {$medicine->name}. Available: {$medicine->remain_qty}.");
            }
        
            // Retrieve or initialize the cart
            $cart = session()->get('cart', []);
        
            // Calculate the total price for the item
            $itemTotalPrice = $medicine->selling_price * $quantity;
        
            // Update the cart
            if (isset($cart[$medicineId])) {
                // Check if the updated quantity exceeds the available stock
                if (($cart[$medicineId]['quantity'] + $quantity) > $medicine->remain_qty) {
                    return back()->with('error', "Not enough stock for {$medicine->name}. Available: {$medicine->remain_qty}.");
                }
        
                $cart[$medicineId]['quantity'] += $quantity;
                $cart[$medicineId]['total_price'] += $itemTotalPrice;
            } else {
                $cart[$medicineId] = [
                    'quantity' => $quantity,
                    'total_price' => $itemTotalPrice,
                    'selling_price' => $medicine->selling_price,
                    'medicine_name' => $medicine->name,
                ];
            }
        
            // Calculate the overall total price of the cart
            $cart['total_price'] = 0;
            foreach ($cart as $id => $item) {
                if ($id !== 'total_price') {
                    $cart['total_price'] += $item['total_price'];
                }
            }
        
            // Store the updated cart in the session
            session()->put('cart', $cart);
        
            return redirect()->route('welcome')->with('success', 'Medicine added to cart successfully!');
    }
    
    public function removeFromCart($medicineId)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);
    
        // Remove the medicine from the cart and subtract its total price
        if (isset($cart[$medicineId])) {
            $cart['total_price'] -= $cart[$medicineId]['total_price'];
            unset($cart[$medicineId]);
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
        foreach ($cart as $medicineId => $item) {
            if ($medicineId !== 'total_price') {
                $medicine = Medicine::find($medicineId);
    
                if ($item['quantity'] > $medicine->remain_qty) {
                    return redirect()->route('welcome')->with('error', "Not enough stock for {$medicine->name}. Available: {$medicine->remain_qty}.");
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
        foreach ($cart as $medicineId => $item) {
            if ($medicineId !== 'total_price') {
                OrderItem::create([
                    'order_id' => $order->id,
                    'medicine_id' => $medicineId,
                    'quantity' => $item['quantity'],
                    'price' => $item['selling_price'],
                    'total' => $item['total_price']
                ]);
    
                // Update stock
                Medicine::where('id', $medicineId)->decrement('remain_qty', $item['quantity']);
                Medicine::where('id', $medicineId)->increment('sold_qty', $item['quantity']);
            }
        }
    
        // Generate QR code with only the Order ID
        $qrCodeData = $order->id; // Only the Order ID is stored in the QR code
    
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data($qrCodeData) // The Order ID is the data for the QR code
            ->encoding(new Encoding('UTF-8'))
            ->size(200) // Size of the QR code image
            ->errorCorrectionLevel(ErrorCorrectionLevel::High) // Error correction level
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


    
