<?php

namespace App\Filament\Resources\MarketStudiesSupplierResource\Pages;

use App\Filament\Resources\MarketStudiesSupplierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarketStudiesSuppliers extends ListRecords
{
    protected static string $resource = MarketStudiesSupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
