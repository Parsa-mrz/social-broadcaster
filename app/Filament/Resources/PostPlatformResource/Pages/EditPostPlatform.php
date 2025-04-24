<?php

namespace App\Filament\Resources\PostPlatformResource\Pages;

use App\Filament\Resources\PostPlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPostPlatform extends EditRecord
{
    protected static string $resource = PostPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
