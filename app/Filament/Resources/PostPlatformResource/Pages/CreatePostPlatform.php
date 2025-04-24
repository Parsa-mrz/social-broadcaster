<?php

namespace App\Filament\Resources\PostPlatformResource\Pages;

use App\Filament\Resources\PostPlatformResource;
use App\Models\PostPlatform;
use App\Models\SocialAccount;
use App\Services\SubscriptionService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use function dd;
use function intval;

class CreatePostPlatform extends CreateRecord
{
    protected static string $resource = PostPlatformResource::class;

    protected function beforeCreate ()
    {
        $subscriptionService = app(SubscriptionService::class);
        $platform = SocialAccount::find($this->data['social_account_id'])->platform;
        if(!$subscriptionService->hasRemainingUsage ($platform)){
            Notification::make()
                        ->title('Usage Limit Exceeded')
                        ->body("You have reached the usage limit for platform: {$platform}.")
                        ->danger()
                        ->send();

            $this->halt ();
        }
    }
    protected function afterCreate(): void
    {
        /** @var PostPlatform $record */
        $record = $this->record;
        $record->load(['post', 'socialAccount']);

        $subscriptionService = app(SubscriptionService::class);
        $subscriptionService->updateSubscriptionUsage ( [
            'platform' => $record->socialAccount->platform,
            'used' => 1
        ]);
    }

}
