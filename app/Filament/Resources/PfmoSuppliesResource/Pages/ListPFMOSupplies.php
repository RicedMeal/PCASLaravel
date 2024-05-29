<?php

namespace App\Filament\Resources\PFMOSuppliesResource\Pages;

use App\Filament\Resources\PFMOSuppliesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPFMOSupplies extends ListRecords
{
    protected static string $resource = PFMOSuppliesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
