<?php

namespace App\Observers;

use App\Enums\SocialAccountEnum;
use App\Models\SocialAccount;
use App\Models\User;
use App\Services\SocialAccountService;

class UserObserver
{

    public function __construct (protected SocialAccountService $socialAccountService)
    {

    }
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $this->socialAccountService->createSocialAccountsForUser($user->id);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
