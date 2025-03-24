<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medicine;
use App\Models\MedicineBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
class AdminController extends Controller
{
    public function index()
    {
        // $users = User::where('id', '!=', auth()->id())->get();
        $users=User::where('id','!=',Auth::id())->get();
        $suppliers=Supplier::all();
        // dd($suppliers);
        // dd(route('admin.storeMedicine'));

        return view('admin.index',compact('users','suppliers'));
    }
    public function activate(User $user)
    {
        $user->update(['active' => true]);
        // $user->save();
        // dd($user);
        return back()->with('success', 'User activated successfully!');
    }

    public function deactivate(User $user)
    {
        $user->update(['active' => false]);
        return back()->with('success', 'User deactivated successfully!');
    }

    public function storeUsers(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Create the user
    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']), // Hash the password
        'active' => true, // Set the user as active by default
        'role' => 0, // Default role (assuming 0 is normal user, change as needed)
    ]);

    // Redirect with success message
    return redirect()->back()->with('success', 'User created successfully!');
}
public function storeMedicine(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'supplier_id' => 'required|exists:suppliers,id',
            'registered_qty' => 'required|integer|min:1',
            'expiry_date' => 'required|date|after:today',
            'selling_price' => 'required|numeric|min:0',
            'profit' => 'required|numeric|min:0'
        ]);

        $medicine = Medicine::where('name', $request->name)->first();

        if (!$medicine) {
            $lastMedicine = Medicine::orderBy('id', 'desc')->first();
            $newCode = 'M' . str_pad(($lastMedicine ? $lastMedicine->id + 1 : 1), 3, '0', STR_PAD_LEFT);
            $medicine = Medicine::create([
                'code' => $newCode,
                'name' => $request->name,
                'category' => $request->category,
                'supplier_id' => $request->supplier_id
            ]);
        }

        $lastBatch = MedicineBatch::where('medicine_id', $medicine->id)->orderBy('id', 'desc')->first();
        $batchNumber = $lastBatch ? ((int)substr($lastBatch->batch_code, -1) + 1) : 1;
        $batchCode = 'M' . str_pad($medicine->id, 3, '0', STR_PAD_LEFT) . "-B$batchNumber";

        MedicineBatch::create([
            'medicine_id' => $medicine->id,
            'batch_code' => $batchCode,
            'registered_qty' => $request->registered_qty,
            'sold_qty' => 0,
            'remain_qty' => $request->registered_qty,
            'registered_date' => Carbon::now(),
            'expiry_date' => $request->expiry_date,
            'selling_price' => $request->selling_price,
            'profit' => $request->profit,
            'remark' => $request->registered_qty > 50 ? 'In Stock' : 'Low Stock',
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'Medicine and batch saved successfully.');
    }
    }


