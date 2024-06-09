<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketStudiesSupplierResource\Pages;
use App\Filament\Resources\MarketStudiesSupplierResource\RelationManagers;
use App\Models\MarketStudiesItems;
use App\Models\MarketStudiesSupplier;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class MarketStudiesSupplierResource extends Resource
{
    protected static ?string $model = MarketStudiesSupplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $modelLabel = 'Market Studies Supplier';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT (in-house)';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Market Studies Supplier Information')
                            ->icon('heroicon-m-truck')
                            ->collapsible()
                            ->iconPosition(IconPosition::Before)
                            ->description('Fill the necessary information for the Supplier. The Sub-Total will be calculated automatically.')
                            //>badgeColor('success')
                            ->columns(4)
                            ->iconPosition(IconPosition::Before)
                            ->schema([
                                TextInput::make('supplier_name')
                                    ->label('Supplier Name')
                                    ->required()
                                    ->placeholder('Enter Supplier Name')
                                    ->rules('string', 'max:150'),
                                TextInput::make('supplier_address')
                                    ->label('Supplier Address')
                                    ->required()
                                    ->placeholder('Enter Supplier Address')
                                    ->rules('string', 'max:150'),
                                PhoneInput::make('supplier_contact')
                                    ->label('Supplier Contact')
                                    ->required()
                                    ->placeholder('Enter Supplier Contact')
                                    ->initialCountry('PH'),
                                TextInput::make('sub_total')
                                    ->label('Sub-Total')
                                    ->prefix('₱')
                                    ->helperText('Do not enter any value. This field will be calculated automatically.')
                                    ->type('number')
                                    ->rules('numeric', 'gt:0.00')
                                    ->readOnly(),
                            ]),
                Section::make('Market Studies Supplier Items')
                            ->icon('heroicon-m-banknotes')
                            ->collapsible()
                            ->description('Fill the necessary information for the Supplier Items.')
                            ->iconPosition(IconPosition::Before)
                            ->schema([
                                Repeater::make('ms_supplier_items')
                                    ->label('Supplier Items Price')
                                    ->addActionLabel('Add Supplier Item')
                                    ->relationship('ms_supplier_items')
                                    ->collapsible()
                                    ->columns(3)
                                    ->schema([
                                       Select::make('market_studies_items_id')
                                        ->label('Item ID')
                                        ->required()
                                        ->helperText('Select an Item from the Market Studies Items List')
                                        ->options(
                                            MarketStudiesItems::all()->mapWithKeys(function ($marketStudiesItem) {
                                                return [$marketStudiesItem->id => $marketStudiesItem->id . ' - ' . $marketStudiesItem->particulars];
                                            })->toArray()
                                        ),
                                        TextInput::make('unit_price')
                                            ->label('Unit Price')
                                            ->required()
                                            ->prefix('₱')
                                            ->type('number')
                                            ->rules('numeric')
                                            ->helperText('Unit Price of the Item of the Supplier')
                                            ->placeholder('Enter Unit Price'),

                                        TextInput::make('amount_per_supplier')
                                            ->label('Amount Per Supplier')
                                            ->prefix('₱')
                                            ->rules('numeric')
                                            ->type('number')
                                            ->helperText('Amount of the Item of the Supplier')
                                            ->placeholder('Enter Amount'),
                                    ])
                                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier_name')
                    ->label('Supplier Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('supplier_address')
                    ->label('Supplier Address')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('supplier_contact')
                    ->label('Supplier Contact')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Created')
                    ->searchable()
                    ->sortable()
                    ->date(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->searchable()
                    ->sortable()
                    ->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->color('primary'),
                    Tables\Actions\EditAction::make()
                        ->color('primary'),
                    ])
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
            'index' => Pages\ListMarketStudiesSuppliers::route('/'),
            'create' => Pages\CreateMarketStudiesSupplier::route('/create'),
            'edit' => Pages\EditMarketStudiesSupplier::route('/{record}/edit'),
        ];
    }
}
