<?php

namespace App\Filament\Resources\PfmoSuppliesResource\Pages;

use App\Filament\Resources\PfmoSuppliesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPfmoSupplies extends EditRecord
{
    protected static string $resource = PfmoSuppliesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
