<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    private function getUserById($id)
    {
        return User::find($id);
    }

    public function show_profile($id)
    {
        $user = $this->getUserById($id);
        return view('profile', compact('user'));
    }

    public function edit_profile($id)
    {
        $user = $this->getUserById($id);
        return view('edit_profile', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $user = $this->getUserById($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->picture = $imageName;
        }

        $user->save();

        return redirect()->route('profile', $id)->with('success', 'Profile updated successfully.');
    }


    public function changePasswordForm($id)
    {
        $user = $this->getUserById($id);
        return view('change_password', compact('user'));
    }

    public function changePassword(Request $request, $id)
    {
       // dd($request);
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = $this->getUserById($id);
  

        // Check if the entered current password matches the user's current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile', ['id' => $id])->with('success', 'Password changed successfully.');
    }


}
