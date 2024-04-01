<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PriceQuotationsERP extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.price-quotations-e-r-p';

    protected static ?string $title = 'Price Quotations';

    protected static ?string $navigationGroup = 'VENDOR MANAGEMENT';

    protected static ?int $navigationSort = 3;
}
