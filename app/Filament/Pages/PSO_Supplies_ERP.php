<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PSO_Supplies_ERP extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static string $view = 'filament.pages.inventory-e-r-p';

    protected static ?string $title = 'PSO Supplies';

    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    protected static ?int $navigationSort = 5;
}
