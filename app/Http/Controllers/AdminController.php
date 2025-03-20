<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // $users = User::where('id', '!=', auth()->id())->get();
        $users=User::where('id','!=',Auth::id())->get();

        return view('admin.index',compact('users'));
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

    public function store(Request $request)
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

}
