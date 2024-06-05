<?php

namespace App\Filament\Resources\StockCardResource\Pages;

use App\Filament\Resources\StockCardResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockCards extends ListRecords
{
    protected static string $resource = StockCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
