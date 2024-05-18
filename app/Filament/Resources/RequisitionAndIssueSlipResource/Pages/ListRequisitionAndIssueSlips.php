<?php

namespace App\Filament\Resources\RequisitionAndIssueSlipResource\Pages;

use App\Filament\Resources\RequisitionAndIssueSlipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequisitionAndIssueSlips extends ListRecords
{
    protected static string $resource = RequisitionAndIssueSlipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
