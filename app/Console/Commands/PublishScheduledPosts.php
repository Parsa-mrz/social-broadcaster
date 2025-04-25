<?php

namespace App\Console\Commands;

use App\Enums\PostPlatformStatusEnum;
use App\Models\PostPlatform;
use App\Services\Social\SocialGatewayFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Publish scheduled posts to social platforms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Publishing scheduled posts...');

        $platforms = PostPlatform::where('status', PostPlatformStatusEnum::SCHEDULED)
                                 ->where('scheduled_at', '<=', now())
                                 ->with(['post', 'socialAccount'])
                                 ->get();


        foreach ($platforms as $platform) {
            try {
                $service = SocialGatewayFactory::make($platform->socialAccount->platform);
                $response = $service->publish($platform->post, $platform->socialAccount);

                $platform->update([
                    'status' => PostPlatformStatusEnum::PUBLISHED,
                    'published_at' => Carbon::now(),
                    'responses' => $response,
                ]);

                $this->info("Post ID {$platform->id} published successfully.");
            } catch (\Throwable $e) {
                $platform->update([
                    'status' => PostPlatformStatusEnum::FAILED,
                    'responses' => ['error' => $e->getMessage()],
                ]);

                $this->error("Failed to publish Post ID {$platform->id}: {$e->getMessage()}");
            }
        }

        $this->info('Done.');
    }
}
