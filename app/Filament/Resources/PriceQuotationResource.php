<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceQuotationResource\Pages;
use App\Filament\Resources\PriceQuotationResource\RelationManagers;
use App\Models\PriceQuotation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceQuotationResource extends Resource
{
    protected static ?string $model = PriceQuotation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = 'Price Quotations';

    protected static ?string $navigationGroup = 'PROCUREMENT OFFICE';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('PriceQuotation_file_name')
                    ->label('Price Quotation File Name')
                    ->searchable()
                    ->sortable()
                    ->date()
                    ->toggleable(),
                TextColumn::make('PriceQuotation')
                    ->label('File')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Price Quotation File'),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPriceQuotations::route('/'),
            'create' => Pages\CreatePriceQuotation::route('/create'),
            'edit' => Pages\EditPriceQuotation::route('/{record}/edit'),
        ];
    }
}
