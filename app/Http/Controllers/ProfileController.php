<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // if ($request->password) {
        //     auth()->user()->update(['password' => Hash::make($request->password)]);
        // }

        // auth()->user()->update([
        //     'username' => $request->username,
        // ]);

        // return redirect()->back()->with('success', 'Profile updated.');

        // Retrieve the currently authenticated user (you may need to handle authentication logic)
        // Retrieve the currently authenticated user (you may need to handle authentication logic)
        $user = User::find(auth()->id());

        if (!$user) {
            return redirect()->route('login'); // Redirect to the login page if the user is not found
        }

        // Update the name field
        $user->update([
            'username' => $request->input('username'),
        ]);

        // Check if the password field is present in the request
        if ($request->has('password')) {
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        // Use dd() to check if the data was updated
        dd('User data updated successfully.');

        // You can also redirect back with a success message if you don't want to halt execution with dd()
        // return redirect()->back()->with('success', 'Profile updated.');
    }

    public function UpdateProfile(Request $request){
        // Retrieve the authenticated user's ID
        $user_id = auth()->id();
    
        // Find the user by ID and update the fields
        User::findOrFail($user_id)->update([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash the password before updating
        ]);
    
        // Create a notification message
        $notification = [
            'message' => 'Data berhasil diperbarui',
            'alert-type' => 'success'
        ];
    
        // Redirect back to the home route with the notification message
        return redirect()->route('home')->with($notification);
    }
    
}
