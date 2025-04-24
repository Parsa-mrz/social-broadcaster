<?php

namespace App\Services\Social;

class SocialGatewayFactory
{
    public static function make(string $platform)
    {
        return match (strtolower($platform)) {
            'instagram' => new TelegramGateway(),
            'wordpress' => new WordpressGateway(),
            'telegram'  => new TelegramGateway(),
            default => throw new \InvalidArgumentException("Unsupported platform [$platform]"),
        };
    }
}
