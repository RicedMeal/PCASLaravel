<?php

namespace App\Filament\Resources\PurchaseRequestFormResource\Pages;

use App\Filament\Resources\PurchaseRequestFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPurchaseRequestForm extends EditRecord
{
    protected static string $resource = PurchaseRequestFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
