<?php

namespace App\Services\Social;

interface SocialGatewayInterface
{
    public function publish(string $title, string $content, string $imagePath, array $credentials): bool;
}
