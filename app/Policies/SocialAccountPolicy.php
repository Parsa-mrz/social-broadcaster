<?php

namespace App\Policies;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SocialAccountPolicy
{
    /**
     * Determine whether the user can decrypt the model's settings.
     */
    public function decrypt(User $user, SocialAccount $socialAccount): bool
    {
        return $user->id === $socialAccount->user_id;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isCustomer ();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SocialAccount $socialAccount): bool
    {
        return $socialAccount->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SocialAccount $socialAccount): bool
    {
        return $socialAccount->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SocialAccount $socialAccount): bool
    {
        return $socialAccount->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SocialAccount $socialAccount): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SocialAccount $socialAccount): bool
    {
        return false;
    }

}
