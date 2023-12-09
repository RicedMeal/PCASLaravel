<?php

namespace App\Filament\Resources\PriceQuotationsResource\Pages;

use App\Filament\Resources\PriceQuotationsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceQuotations extends EditRecord
{
    protected static string $resource = PriceQuotationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
