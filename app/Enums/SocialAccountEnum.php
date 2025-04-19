<?php

namespace App\Enums;

enum SocialAccountEnum:string
{
    case WordPress = 'wordpress';
    case Instagram = 'instagram';
    case Telegram = 'telegram';
    case Username = 'username';
    case Password = 'password';
    case API_Token = 'api_token';
    case Bot_Token = 'bot_token';
    case SiteUrl = 'site_url';
    case ChatId = 'chat_id';
    case AccessToken = 'access_token';

}
