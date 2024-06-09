<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuppliesResource\Pages;
use App\Filament\Resources\SuppliesResource\RelationManagers;
use App\Models\Supplies;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuppliesResource extends Resource
{
    protected static ?string $model = Supplies::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $modelLabel = 'PSO Supplies';

    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('stock_no')
                    ->readOnly()
                    ->label('Stock No.'),
                TextInput::make('description')
                    ->readOnly()
                    ->label('Description'),
                TextInput::make('unit')
                    ->readOnly()
                    ->label('Unit'),
                TextInput::make('delivered')
                    ->readOnly()
                    ->label('Delivered'),
                TextInput::make('issued')
                    ->readOnly()
                    ->label('Issued'),
                TextInput::make('balance_after')
                    ->readOnly()
                    ->label('Balance After'),
                TextInput::make('status')
                    ->readOnly()
                    ->label('status'),
                TextInput::make('date_issuance')
                    ->readOnly()
                    ->label('Date Issuance'),
                TextInput::make('requesting_office')
                    ->readOnly()
                    ->label('Requesting Office'),       
                TextInput::make('report_no')
                    ->readOnly()
                    ->label('Report No.'),
                TextInput::make('ris_no')
                    ->readOnly()
                    ->label('Ris No.'),
                TextInput::make('delivery_date')
                    ->readOnly()
                    ->label('Delivery Date'),
                TextInput::make('actual_delivery_date')
                    ->readOnly()
                    ->label('Actual Delivery Date'),
                TextInput::make('acceptance_date')
                    ->readOnly()
                    ->label('Acceptance Date'),
                TextInput::make('iar_no')
                    ->readOnly()
                    ->label('IAR No.'),
                TextInput::make('item_no')
                    ->readOnly()
                    ->label('Item No.'),
                TextInput::make('dr_no')
                    ->readOnly()
                    ->label('Dr No.'),
                TextInput::make('check_no')
                    ->readOnly()
                    ->label('Check No.'),
                TextInput::make('po_no')
                    ->readOnly()
                    ->label('PO No.'),
                TextInput::make('po_date')
                    ->readOnly()
                    ->label('PO Date.'),
                TextInput::make('po_amount')
                    ->readOnly()
                    ->label('PO Amount'),
                TextInput::make('pr_no')
                    ->readOnly()
                    ->label('PR Number'),
                TextInput::make('price_per_purchase_request')
                    ->readOnly()
                    ->label('Price per Purchase Request'),
                TextInput::make('bur')
                    ->readOnly()
                    ->label('BUR'),
                TextInput::make('remarks')
                    ->readOnly()
                    ->label('Remarks'),
                TextInput::make('added')
                    ->readOnly()
                    ->label('added'),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bur')
                  ->label('BUR No.')
                  ->searchable()
                  ->sortable()
                  ->toggleable(),
                TextColumn::make('iar_no')
                ->label('IAR No.')
                ->searchable()
                ->sortable()
                ->toggleable(),
                TextColumn::make('item_no')
                    ->label('Items No.')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('stock_no')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Stock No.'),
                TextColumn::make('item_description')
                    ->label('Description')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('supplier')
                    ->label('Supplier')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
              TextColumn::make('stock_type')
                    ->label('Stock Type')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('pr_number')
                    ->label('PR No.')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                #Tables\Actions\ActionGroup::make([
                    #Tables\Actions\ViewAction::make()
                      #  ->color('primary'),
                    #Tables\Actions\EditAction::make()
                    #    ->color('primary'),
                   # ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                 #   Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSupplies::route('/'),
           # 'create' => Pages\CreateSupplies::route('/create'),
           # 'edit' => Pages\EditSupplies::route('/{record}/edit'),
        ];
    }
}
