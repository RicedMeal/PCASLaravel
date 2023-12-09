<?php

namespace App\Filament\Resources\PriceQuotationsResource\Pages;

use App\Filament\Resources\PriceQuotationsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceQuotations extends ListRecords
{
    protected static string $resource = PriceQuotationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
