<?php

namespace App\Services\Social;

use Illuminate\Support\Facades\Http;

class WordpressGateway implements SocialGatewayInterface
{
    public function publish(string $title, string $content, string $imagePath,array $credentials): bool
    {
        $imageUrl = asset('storage/' . $imagePath);

        $response = Http::withBasicAuth($credentials['username'], $credentials['password'])
                        ->post("{$credentials['site_url']}/posts", [
                            'title'   => $title,
                            'content' => "<img src=\"$imageUrl\" /><p>$content</p>",
                            'status'  => 'publish'
                        ]);

        return $response->successful();
    }
}
