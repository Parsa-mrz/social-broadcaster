<?php

namespace App\Services\Social;

class InstagramGateway implements SocialGatewayInterface
{
    public function publish(string $title, string $content, string $imagePath,array $credentials): bool
    {
        // Use Instagram API logic here
        logger("Posting to Instagram: $title");
        return true;
    }
}
