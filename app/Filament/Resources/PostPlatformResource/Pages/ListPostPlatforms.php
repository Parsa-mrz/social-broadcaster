<?php

namespace App\Filament\Resources\PostPlatformResource\Pages;

use App\Filament\Resources\PostPlatformResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPostPlatforms extends ListRecords
{
    protected static string $resource = PostPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
