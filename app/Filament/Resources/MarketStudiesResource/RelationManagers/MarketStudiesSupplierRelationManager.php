<?php

namespace App\Filament\Resources\MarketStudiesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\MarketStudies;
use App\Models\MarketStudiesItems;
use App\Models\MarketStudiesSupplier;
use App\Models\MarketStudiesSuppliersItems;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class MarketStudiesSupplierRelationManager extends RelationManager
{
    protected static string $relationship = 'market_studies_supplier';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('supplier_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('supplier_address')
                    ->required()
                    ->maxLength(255),
                PhoneInput::make('supplier_contact_no')::make('supplier_contact')
                    ->required()
                    ->label('Supplier Contact No.')
                    ->placeholder('Enter Supplier Contact No.')
                    ->initialCountry('ph'),
                Forms\Components\TextInput::make('market_studies_id')
                    ->label('Item ID')
                    ->hidden(),
                Forms\Components\TextInput::make('market_studies_items_id')
                    ->label('Item ID')
                    ->hidden(),
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('supplier_name')
            ->columns([
                Tables\Columns\TextColumn::make('supplier_name'),
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
