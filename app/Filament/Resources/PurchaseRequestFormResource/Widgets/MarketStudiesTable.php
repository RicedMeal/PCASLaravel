<?php

namespace App\Filament\Resources\PurchaseRequestFormResource\Widgets;

use App\Models\MarketStudiesItems;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MarketStudiesTable extends BaseWidget
{
    protected int | string | array $columnSpan = '2';
    public function table(Table $table): Table
    {
        return $table
            ->query(MarketStudiesItems::query())
            ->columns([
                // ...
                Tables\Columns\TextColumn::make('item_no')
                    ->searchable()
                    ->sortable()
                    ->label('Item No.'),
                Tables\Columns\TextColumn::make('particulars')
                    ->searchable()
                    ->sortable()
                    ->label('Particulars'),
                Tables\Columns\TextColumn::make('unit')
                    ->searchable()
                    ->sortable()
                    ->label('Unit'),
                Tables\Columns\TextColumn::make('quantity')
                    ->searchable()
                    ->sortable()
                    ->label('Quantity'),
                Tables\Columns\TextColumn::make('average_unit_price')
                    ->searchable()
                    ->sortable()
                    ->label('Average Unit Price'),
                Tables\Columns\TextColumn::make('average_amount')
                    ->searchable()
                    ->sortable()
                    ->label('Average Amount'),
                Tables\Columns\TextColumn::make('average_subtotal')
                    ->searchable()
                    ->sortable()
                    ->label('Average Subtotal'),
                
            ]);
    }
}
