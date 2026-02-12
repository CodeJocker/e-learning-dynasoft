<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        // Points to resources/views/admin/profile/edit.blade.php
        return view('admin.profile.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validate all 4 requirements: name, email, phone, and image
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ]);

        // 1. Handle Profile Picture Upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists to save space
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            // Store the new image in the 'profiles' directory
            $path = $request->file('profile_image')->store('profiles', 'public');
            $validated['profile_image'] = $path;
        }

        // 2. Handle Password Change (Only update if the field is filled)
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            // Remove password from array so it's not updated to null
            unset($validated['password']);
        }

        // 3. Update the User details (Name, Email, Phone)
        $user->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}