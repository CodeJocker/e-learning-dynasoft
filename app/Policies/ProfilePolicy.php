<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;

class ProfilePolicy
{
    /**
     * Determine whether the user can view the profile.
     */
    public function view(User $authUser, Profile $profile): bool
    {
        // Own profile
        if ($authUser->id === $profile->user_id) {
            return true;
        }

        // Admin can view any profile
        if ($authUser->isAdmin()) {
            return true;
        }

        // Check privacy settings
        return match($profile->privacy_setting) {
            'public' => true,
            'friends' => false, // Implement friendship logic later
            'private' => false,
            default => false,
        };
    }

    /**
     * Determine whether the user can update the profile.
     */
    public function update(User $authUser, Profile $profile): bool
    {
        return $authUser->id === $profile->user_id || $authUser->isAdmin();
    }

    /**
     * Determine whether the user can delete the profile.
     */
    public function delete(User $authUser, Profile $profile): bool
    {
        return $authUser->id === $profile->user_id || $authUser->isAdmin();
    }
}
