<?php

namespace App\Filament\Resources\MarketStudiesResource\Pages;

use App\Filament\Resources\MarketStudiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarketStudies extends ListRecords
{
    protected static string $resource = MarketStudiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
