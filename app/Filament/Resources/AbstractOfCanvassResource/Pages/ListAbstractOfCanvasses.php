<?php

namespace App\Filament\Resources\AbstractOfCanvassResource\Pages;

use App\Filament\Resources\AbstractOfCanvassResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAbstractOfCanvasses extends ListRecords
{
    protected static string $resource = AbstractOfCanvassResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
