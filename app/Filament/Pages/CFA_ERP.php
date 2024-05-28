<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class CFA_ERP extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.budget-documents';

    protected static ?string $title = 'Certificate of Fund Allotment';

    protected static ?string $navigationGroup = 'BUDGET OFFICE';

}
