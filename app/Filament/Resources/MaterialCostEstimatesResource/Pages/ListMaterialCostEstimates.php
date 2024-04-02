<?php

namespace App\Filament\Resources\MaterialCostEstimatesResource\Pages;

use App\Filament\Resources\MaterialCostEstimatesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaterialCostEstimates extends ListRecords
{
    protected static string $resource = MaterialCostEstimatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
