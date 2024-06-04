<?php

namespace App\Filament\Resources\MarketStudiesResource\RelationManagers;

use App\Models\MarketStudiesItems;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuppliersItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'suppliers_items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('market_studies_id')
                ->label('Item ID')
                ->hidden(),
                Forms\Components\Select::make('market_studies_supplier_id')
                ->label('Supplier ID')
                ->required()
                ->options(
                    MarketStudiesItems::all()->mapWithKeys(function ($msSupplier) {
                        return [$msSupplier->id => $msSupplier->id . ' - ' . $$msSuppliers->supplier_name];
                    })->toArray()
                ),
                Forms\Components\Select::make('market_studies_items_id')
                ->label('Item ID')
                ->required()
                ->options(
                    MarketStudiesItems::all()->mapWithKeys(function ($msItems) {
                        return [$msItems->id => $msItems->id . ' - ' . $msItems->particulars];
                    })->toArray()
                ),
                Forms\Components\TextInput::make('market_studies_supplier_id')
                    ->label('Item ID')
                    ->hidden()
                    ->default('0'),
                Forms\Components\TextInput::make('market_studies_id')
                    ->label('Item ID')
                    ->hidden()
                    ->default('0'),
                Forms\Components\TextInput::make('unit_price')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('unit_price')
            ->columns([
                Tables\Columns\TextColumn::make('supplier_name'),
                Tables\Columns\TextColumn::make('market_studies_items.particulars'),
                Tables\Columns\TextColumn::make('unit_price'),
                Tables\Columns\TextColumn::make('amount')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
