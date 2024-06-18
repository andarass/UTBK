<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileAdminController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo_path' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->hasFile('profile_photo_path')) {

            if ($user->profile_photo_path) {
                $path = "public/" . $user->profile_photo_path;

                if (Storage::exists($path)) {
                    Storage::delete($path);
                }
            }

            $profileImagePath = $request->file('profile_photo_path')->store('profile_photo_paths', 'public');
            $user->profile_photo_path = $profileImagePath;
        }

        // Simpan perubahan
        $user->save();

        return redirect()->back()->with('success', 'Profile succesfully updated');
    }
    public function change_password()
    {
        return view('change-password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|max:100',
            'new_password' => 'required|string|max:100',
            'new_password_confirmation' => 'required|same:new_password'
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);

            return redirect()->back()->with('success', 'Password succesfully updated');
        } else {
            return redirect()->back()->with('error', 'Current password does not matched');
        }
    }
}
