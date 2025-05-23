<?php

namespace App\Filament\Resources\SocialAccountResource\Pages;

use App\Filament\Resources\SocialAccountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSocialAccount extends EditRecord
{
    protected static string $resource = SocialAccountResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
