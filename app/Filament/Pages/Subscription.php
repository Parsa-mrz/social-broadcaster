<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Subscription extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.subscription';
    public function getTitle(): string
    {
        return '';
    }
}
