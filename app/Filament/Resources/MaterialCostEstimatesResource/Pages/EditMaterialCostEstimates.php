<?php

namespace App\Filament\Resources\MaterialCostEstimatesResource\Pages;

use App\Filament\Resources\MaterialCostEstimatesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaterialCostEstimates extends EditRecord
{
    protected static string $resource = MaterialCostEstimatesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
