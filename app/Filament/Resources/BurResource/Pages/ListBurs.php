<?php

namespace App\Filament\Resources\BurResource\Pages;

use App\Filament\Resources\BurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBurs extends ListRecords
{
    protected static string $resource = BurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
