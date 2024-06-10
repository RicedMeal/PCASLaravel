<?php

namespace App\Filament\Resources\PurchaseRequestFormResource\Pages;

use App\Filament\Resources\PurchaseRequestFormResource;
use App\Filament\Resources\PurchaseRequestFormResource\Widgets\MarketStudiesTable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPurchaseRequestForms extends ListRecords
{
    protected static string $resource = PurchaseRequestFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            MarketStudiesTable::class
        ];
    }
}
