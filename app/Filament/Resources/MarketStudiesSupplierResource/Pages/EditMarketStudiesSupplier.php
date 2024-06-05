<?php

namespace App\Filament\Resources\MarketStudiesSupplierResource\Pages;

use App\Filament\Resources\MarketStudiesSupplierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarketStudiesSupplier extends EditRecord
{
    protected static string $resource = MarketStudiesSupplierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
