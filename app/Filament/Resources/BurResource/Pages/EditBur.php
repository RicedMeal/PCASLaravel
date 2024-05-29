<?php

namespace App\Filament\Resources\BurResource\Pages;

use App\Filament\Resources\BurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBur extends EditRecord
{
    protected static string $resource = BurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
