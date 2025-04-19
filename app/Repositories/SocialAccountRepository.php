<?php

namespace App\Repositories;

use App\Models\SocialAccount;

class SocialAccountRepository
{
    /**
     * Create a new social account.
     *
     * @param int $userId
     * @param string $platform
     * @param array $settings
     * @return SocialAccount
     */
    public function createSocialAccount(int $userId, string $platform, array $settings): SocialAccount
    {
        return SocialAccount::create([
            'user_id' => $userId,
            'platform' => $platform,
            'settings' => $settings,
        ]);
    }
}
