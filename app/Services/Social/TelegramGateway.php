<?php

namespace App\Services\Social;

use App\Models\Post;
use App\Models\SocialAccount;

class TelegramGateway implements SocialGatewayInterface
{
    public function publish(Post $post,SocialAccount $socialAccount): bool
    {

        return true;
    }
}
