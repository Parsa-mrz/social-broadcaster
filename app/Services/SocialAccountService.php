<?php

namespace App\Services;

use App\Enums\SocialAccountEnum;
use App\Repositories\SocialAccountRepository;
use Illuminate\Support\Facades\Log;

class SocialAccountService
{
    /**
     * Create a new service instance.
     *
     * @param SocialAccountRepository $socialAccountRepository
     */
    public function __construct(protected  SocialAccountRepository $socialAccountRepository)
    {
    }

    /**
     * Create social accounts for a newly created user.
     *
     * @param int $userId
     * @return void
     */
    public function createSocialAccountsForUser(int $userId): void
    {
        try {
            // Create Instagram SocialAccount
            $this->socialAccountRepository->createSocialAccount($userId, SocialAccountEnum::Instagram->value, [
                [
                    'key' => SocialAccountEnum::AccessToken->value,
                    'value' => ''
                ]
            ]);

            // Create Telegram SocialAccount
            $this->socialAccountRepository->createSocialAccount($userId, SocialAccountEnum::Telegram->value, [
                [
                    'key' => SocialAccountEnum::Bot_Token->value,
                    'value' => ''
                ],
                [
                    'key' => SocialAccountEnum::ChatId->value,
                    'value' => ''
                ],
            ]);

            // Create WordPress SocialAccount
            $this->socialAccountRepository->createSocialAccount($userId, SocialAccountEnum::WordPress->value, [
                [
                  'key' => SocialAccountEnum::SiteUrl->value,
                  'value' => ''
                ],
                [
                  'key' => SocialAccountEnum::Username->value,
                  'value' => ''
                ],
                [
                  'key' => SocialAccountEnum::Password->value,
                  'value' => ''
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating social accounts for user: ' . $userId, ['exception' => $e]);
        }
    }
}
