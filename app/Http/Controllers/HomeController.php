<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
class HomeController extends Controller
{
   
    // Initial load of the welcome page
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
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

        // Pass the results and cart to the view
        return view('welcome', compact('medicines', 'search', 'cart'));
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
    
        if (!$medicine) {
            return back()->with('error', 'Medicine not found');
        }
    
        $cart = session()->get('cart', []);
    
        $itemTotalPrice = $medicine->selling_price * $quantity;
    
        if (isset($cart[$medicineId])) {
            $cart[$medicineId]['quantity'] += $quantity;
            $cart[$medicineId]['total_price'] += $itemTotalPrice;
    
            // Ensure the medicine name is always set
            $cart[$medicineId]['medicine_name'] = $medicine->name;
        } else {
            $cart[$medicineId] = [
                'quantity' => $quantity,
                'total_price' => $itemTotalPrice,
                'selling_price' => $medicine->selling_price,
                'medicine_name' => $medicine->name, // Ensure this is always set
            ];
        }
    
        // Calculate the overall total price of the cart
        $cart['total_price'] = 0;
        foreach ($cart as $id => $item) {
            if ($id !== 'total_price') {
                $cart['total_price'] += $item['total_price'];
            }
        }
    
        session()->put('cart', $cart);
        session()->save(); // Ensure session is saved
    
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

    public function completePurchase(){
        $cart=session()->get('cart',[]);
        if (!Auth::check() || empty($cart)){
 
            return redirect()->route('welcome')->with('error','user not authorized or cart is empty');
        }
        // dd($cart['total_price']);
        $order=Order::create([
            'total_amount'=>$cart['total_price'],
            'status'=>'pending',
            'user_id' => Auth::id()
        ]);

        foreach ($cart as $medicineId => $item)
        {
            if ($medicineId !=='total_price'){
                // dd($item['price']);
                OrderItem::create([
                    'order_id'=>$order->id,
                    'medicine_id'=>$medicineId,
                    'quantity'=>$item['quantity'],
                    'price'=>$item['selling_price'],
                    'total'=>$item['total_price']

                ]);
                Medicine::where('id', $medicineId)->decrement('remain_qty', $item['quantity']);
                Medicine::where('id', $medicineId)->increment('sold_qty', $item['quantity']);



            }
        }
        session()->forget('cart');
        // dd($order);
    
        return redirect()->route('order.details', ['order' => $order->id])
        ->with('success', 'Purchase completed successfully!');    
    }
}


    
