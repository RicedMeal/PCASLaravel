<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class InventoryERP extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static string $view = 'filament.pages.inventory-e-r-p';

    protected static ?string $title = 'Annual Supplies';

    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    protected static ?int $navigationSort = 4;
}
