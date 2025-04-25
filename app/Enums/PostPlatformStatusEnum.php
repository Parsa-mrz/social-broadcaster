<?php

namespace App\Enums;

enum PostPlatformStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case PUBLISHED = 'published';
    case FAILED = 'failed';
}
