<?php

namespace App\Filament\Resources\ProjectResource\Widgets;

use App\Models\Procurements;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AnnualProcurementPlanTable extends BaseWidget
{
    protected int | string | array $columnSpan = '2';
    public function table(Table $table): Table
    {
        return $table
        ->query(Procurements::query())
        ->columns([
            Tables\Columns\TextColumn::make('code')
                ->searchable()
                ->sortable()
                ->label('Code'),
            Tables\Columns\TextColumn::make('procurement_project')
                ->searchable()
                ->sortable()
                ->label('Procurement Project'),
            Tables\Columns\TextColumn::make('end_user')
                ->searchable()
                ->sortable()
                ->label('End-User'),
            Tables\Columns\TextColumn::make('early_procurement')
                ->searchable()
                ->sortable()
                ->label('Early Procurement Project?'),
            Tables\Columns\TextColumn::make('mop')
                ->searchable()
                ->sortable()
                ->label('Mode of Procurement'),
            Tables\Columns\TextColumn::make('advertisement')
                ->searchable()
                ->sortable()
                ->label('Advertisement/Posting of IB/REI'),
            Tables\Columns\TextColumn::make('submission')
                ->searchable()
                ->sortable()
                ->label('Submission/Opening of Bids'),
            Tables\Columns\TextColumn::make('notice_award')
                ->searchable()
                ->sortable()
                ->label('Notice of Award'),
            Tables\Columns\TextColumn::make('contract_signing')
                ->searchable()
                ->sortable()
                ->label('Contract Signing'),
            Tables\Columns\TextColumn::make('source_funds')
                ->searchable()
                ->sortable()
                ->label('Source of Funds'),
            Tables\Columns\TextColumn::make('total')
                ->searchable()
                ->sortable()
                ->label('Total'),
            Tables\Columns\TextColumn::make('mooe')
                ->searchable()
                ->sortable()
                ->label('MOOE'),
            Tables\Columns\TextColumn::make('co')
                ->searchable()
                ->sortable()
                ->label('CO'),
            Tables\Columns\TextColumn::make('remarks')
                ->searchable()
                ->sortable()
                ->label('Remarks'),
            ]);
    }
}
