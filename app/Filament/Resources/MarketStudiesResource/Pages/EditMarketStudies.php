<?php

namespace App\Filament\Resources\MarketStudiesResource\Pages;

use App\Filament\Resources\MarketStudiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMarketStudies extends EditRecord
{
    protected static string $resource = MarketStudiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
