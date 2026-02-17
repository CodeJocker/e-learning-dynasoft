<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    //
    public function show(User $user)
    {
        Gate::authorize('view', $user);
        return view('profile.show', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        Gate::authorize('update', $user);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'skills' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'privacy_setting' => 'required|in:public,private,friends',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Update user
        $user->update([
            'name' => $validated['name'],
            'bio' => $validated['bio'] ?? null,
        ]);

        // Update profile
        $skills = $validated['skills'] ? array_map('trim', explode(',', $validated['skills'])) : [];
        $user->profile->update([
            'bio' => $validated['bio'] ?? null,
            'skills' => $skills,
            'photo' => $validated['avatar'] ?? $user->profile->photo,
            'privacy_setting' => $validated['privacy_setting'],
        ]);

        return redirect()->route('profile.show', $user)->with('success', 'Profile updated successfully');
    }
}
