<?php

namespace App\Filament\Resources\PfmoSuppliesResource\Pages;

use App\Filament\Resources\PfmoSuppliesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPfmoSupplies extends ListRecords
{
    protected static string $resource = PfmoSuppliesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
