<?php

namespace App\Services\Social;

class TelegramGateway implements SocialGatewayInterface
{
    public function publish(string $title, string $content, string $imagePath,array $credentials): bool
    {
        // Use Telegram Bot API logic here
        logger("Posting to Telegram: $title");
        return true;
    }
}
