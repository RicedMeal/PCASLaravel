<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class SuppliersERP extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static string $view = 'filament.pages.suppliers-e-r-p';

    protected static ?string $title = 'Suppliers';

    protected static ?string $navigationGroup = 'PROCUREMENT OFFICE';

    protected static ?int $navigationSort = 4;
}
