<?php

namespace App\Services\Social;

use App\Models\Post;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WordpressGateway implements SocialGatewayInterface
{
    public function publish(Post $post,SocialAccount $socialAccount): bool
    {
        $settings = $socialAccount->getDecryptedSettings();

        $endpoint = $settings['site_url'] . '/wp-json/wp/v2/posts';

        $postData = [
            'title'   => $post->title,
            'content' => $post->content,
            'status'  => 'publish',
        ];

        if ($post->image) {
            $postData['content'] .= "<br><img src='{$post->image}' />";
        }

        $response = Http::withBasicAuth($settings['username'], $settings['password'])
                        ->post($endpoint, $postData);

        if ($response->successful()) {
            return $response->json();
        } else {
            throw new \Exception("Failed to post to WordPress. Status: " . $response->status() . '. Response: ' . $response->body());
        }
    }
}
