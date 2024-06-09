<?php

namespace App\Filament\Resources\ProjectsResource\Widgets;

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
                

            ]);
    }
}

