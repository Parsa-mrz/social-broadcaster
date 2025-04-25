<?php

namespace App\Services\Social;

use App\Models\Post;
use App\Models\SocialAccount;

interface SocialGatewayInterface
{
    public function publish(Post $post, SocialAccount $socialAccount): bool;
}
