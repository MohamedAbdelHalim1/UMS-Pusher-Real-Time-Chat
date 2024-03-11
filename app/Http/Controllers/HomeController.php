<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         // Retrieve all users except admin
         $users = User::withTrashed()->where('role', '!=', 'admin')->where('id','!=' , Auth::user()->id)->get();

         // Check if the authenticated user is an admin
         $isAdmin = Auth::user()->role === 'admin';
 
        
        return view('home' , compact('users' , 'isAdmin'));
    }

    public function show($id) {
        $user = User::find($id);
    
        if (!$user) {
            return abort(404); // User not found
        }
        return view('show_user', compact('user'));
    }

    public function edit(User $user)
    {
        return view('edit_user', compact('user'));
    }



    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);
    
        if ($user) {
            $user->delete(); // Soft delete
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
    
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
    
        if ($user) {
            $user->restore();
            return redirect()->back()->with('success', 'User restored successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
}
