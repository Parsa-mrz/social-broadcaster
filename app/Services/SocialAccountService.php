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
        $socialAccounts = $this->getSocialAccountsData($userId);

        foreach ($socialAccounts as $platform => $settings) {
            $this->createSocialAccount($userId, $platform, $settings);
        }
    }

    /**
     * Prepare the data for social accounts creation.
     *
     * @param int $userId
     * @return array
     */
    private function getSocialAccountsData(int $userId): array
    {
        return [
            SocialAccountEnum::Instagram->value => [
                [
                    'key' => SocialAccountEnum::AccessToken->value,
                    'value' => ''
                ]
            ],
            SocialAccountEnum::Telegram->value => [
                [
                    'key' => SocialAccountEnum::Bot_Token->value,
                    'value' => ''
                ],
                [
                    'key' => SocialAccountEnum::ChatId->value,
                    'value' => ''
                ],
            ],
            SocialAccountEnum::WordPress->value => [
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
            ],
        ];
    }

    /**
     * Create a social account for the user.
     *
     * @param int $userId
     * @param string $platform
     * @param array $settings
     * @return void
     */
    private function createSocialAccount(int $userId, string $platform, array $settings): void
    {
        try {
            $this->socialAccountRepository->createSocialAccount($userId, $platform, $settings);
        } catch (\Exception $e) {
            Log::error("Error creating social account for user {$userId} on platform {$platform}", ['exception' => $e]);
        }
    }
}
