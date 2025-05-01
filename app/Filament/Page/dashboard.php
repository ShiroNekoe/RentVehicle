<?php
use App\Filament\Widgets\RentalOverview;
use Filament\Pages\Page;



class Dashboard extends Page
{
    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            RentalOverview::class,
           
        ];
    }
}

