<?php

namespace App\Filament\Resources\PriceQuotationResource\Pages;

use App\Filament\Resources\PriceQuotationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceQuotations extends ListRecords
{
    protected static string $resource = PriceQuotationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
