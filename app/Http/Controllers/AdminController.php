<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Medicine;
use App\Models\MedicineBatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

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
    // Decode each JSON string inside the array
    $medicinesData = array_map(fn($json) => json_decode($json, true), $request->medicines);

    // Validate the structure
    $validator = Validator::make(['medicines' => $medicinesData], [
        'medicines' => 'required|array',
        'medicines.*.name' => 'required',
        'medicines.*.category' => 'required',
        'medicines.*.supplier_id' => 'required|exists:suppliers,id',
        'medicines.*.registered_qty' => 'required|integer|min:1',
        'medicines.*.expiry_date' => 'required|date|after:today',
        'medicines.*.selling_price' => 'required|numeric|min:0',
        'medicines.*.profit' => 'required|numeric|min:0'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validation failed. Please check the input data.');
    }

    DB::beginTransaction();
    try {
        $createdCount = 0;

        foreach ($medicinesData as $medicineData) {
            // Ensure data is correctly decoded
            if (!is_array($medicineData)) {
                throw new \Exception('Invalid medicine data format.');
            }

            // Find or create medicine
            $medicine = Medicine::firstOrNew(['name' => $medicineData['name']]);

            if (!$medicine->exists) {
                $medicine->code = 'M' . str_pad((Medicine::max('id') + 1), 3, '0', STR_PAD_LEFT);
                $medicine->category = $medicineData['category'];
                $medicine->supplier_id = $medicineData['supplier_id'];
                $medicine->save();
            }

            // Generate batch code
            $batchCode = 'M' . str_pad($medicine->id, 3, '0', STR_PAD_LEFT) . '-B' . (MedicineBatch::where('medicine_id', $medicine->id)->count() + 1);

            // Determine status and remark
            $expiryDate = Carbon::parse($medicineData['expiry_date']);
            $status = $expiryDate->lt(now()->addMonths(3)) ? 'passive' : 'active';
            $remark = $medicineData['registered_qty'] > 50 ? 'In Stock' : 'Low Stock';

            // Create batch
            MedicineBatch::create([
                'medicine_id' => $medicine->id,
                'batch_code' => $batchCode,
                'registered_qty' => $medicineData['registered_qty'],
                'sold_qty' => 0,
                'remain_qty' => $medicineData['registered_qty'],
                'registered_date' => now(),
                'expiry_date' => $expiryDate,
                'selling_price' => $medicineData['selling_price'],
                'profit' => $medicineData['profit'],
                'remark' => $remark,
                'status' => $status
            ]);

            $createdCount++;
        }

        DB::commit();
        return redirect()->back()->with('success', "Successfully added $createdCount medicine records with batches.");
        
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->with('error', 'Failed to save medicines: ' . $e->getMessage())
            ->withInput();
    } finally {
        session()->flash('info', 'Medicine saving process completed.');
    }
}


// Helper method to generate medicine code
protected function generateMedicineCode()
{
    $lastMedicine = Medicine::latest('id')->first();
    return 'M' . str_pad(($lastMedicine ? $lastMedicine->id + 1 : 1), 3, '0', STR_PAD_LEFT);
}

// Helper method to generate batch code
protected function generateBatchCode($medicineId)
{
    $lastBatch = MedicineBatch::where('medicine_id', $medicineId)
        ->orderBy('id', 'desc')
        ->first();

    // Extract batch number correctly
    $batchNumber = $lastBatch ? ((int) preg_replace('/[^0-9]/', '', $lastBatch->batch_code) + 1) : 1;

    return 'M' . str_pad($medicineId, 3, '0', STR_PAD_LEFT) . "-B" . str_pad($batchNumber, 2, '0', STR_PAD_LEFT);
}

    }


