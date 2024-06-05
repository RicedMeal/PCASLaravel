<?php

namespace App\Filament\Resources\StockCardResource\Pages;

use App\Filament\Resources\StockCardResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockCard extends EditRecord
{
    protected static string $resource = StockCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
