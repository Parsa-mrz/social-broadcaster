<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SubscriptionOverview;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public function getHeaderWidgets(): array
    {
        return [
            SubscriptionOverview::class,
        ];
    }
}
