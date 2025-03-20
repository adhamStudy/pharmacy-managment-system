<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
}
