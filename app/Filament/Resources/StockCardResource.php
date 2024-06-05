<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockCardResource\Pages;
use App\Filament\Resources\StockCardResource\RelationManagers;
use App\Models\StockCard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\StockCardList;
use Filament\Forms\Components\Tabs;
use Filament\Support\Enums\IconPosition;

class StockCardResource extends Resource
{
    protected static ?string $model = StockCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT (in-house)';

    protected static ?string $modelLabel = 'Stock Card';

    protected static ?int $navigationSort = 7;

    protected static ?string $modelItems = StockCardList::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Stock Card Information')
                    ->tabs([
                        Tabs\Tab::make('Stock Card General Information')
                            ->icon('heroicon-m-information-circle')
                            ->iconPosition(IconPosition::Before)
                            ->schema([
                                Forms\Components\TextInput::make('entity_name')
                                    ->label('Entity Name')
                                    //->required()
                                    ->placeholder('Enter Entity Name')
                                    ->rules('string', 'max:150'),
                                Forms\Components\TextInput::make('fund_cluster')
                                    ->label('Fund Cluster')
                                    //->required()
                                    ->placeholder('Enter Fund Cluster')
                                    ->rules('string', 'max:150'),
                            ]),
                        Tabs\Tab::make('Stock Card Details')
                            ->icon('heroicon-m-information-circle')
                            ->iconPosition(IconPosition::Before)
                            ->schema([
                                Forms\Components\TextInput::make('item_code')
                                    ->label('Item Code')
                                    ->required()
                                    ->placeholder('Enter Item Code')
                                    ->rules('string', 'max:150'),
                                Forms\Components\TextInput::make('item_description')
                                    ->label('Item Description')
                                    ->required()
                                    ->placeholder('Enter Item Description')
                                    ->rules('string', 'max:150'),
                                Forms\Components\Select::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->columnSpan(1)
                                    ->placeholder('Select Unit')
                                    ->options([
                                        'box' => 'box',
                                        'length' => 'length',
                                        'lot' => 'lot',
                                        'pack' => 'pack',
                                        'pc.' => 'pc.',
                                        'ream' => 'ream',
                                        'roll' => 'roll',
                                        'set' => 'set',
                                        'unit' => 'unit',
                                    ]),
                                Forms\Components\TextInput::make('stock_no')
                                    ->label('Stock No')
                                    //->required()
                                    ->placeholder('Enter Stock No')
                                    ->rules('string', 'max:150'),
                                Forms\Components\TextInput::make('reorder_point')
                                    ->label('Reorder Point')
                                    //->required()
                                    ->placeholder('Enter Reorder Point')
                                    ->rules('string', 'max:150'),
                            ]),
                        Tabs\Tab::make('Stock Card List')
                            ->icon('heroicon-m-clipboard-document-list')
                            ->iconPosition(IconPosition::Before)
                            ->schema([
                                Forms\Components\Repeater::make('stock_card_list')
                                    ->label('Stock Card List')
                                    ->columns(2)
                                    ->relationship('stock_card_list')
                                    ->reorderableWithButtons()
                                    ->collapsible()
                                    ->itemLabel(fn (array $state): ?string => isset($state['date'], $state['reference']) ? $state['date'] . ' - ' . $state['reference'] : null)
                                    ->addActionLabel('Add Stock Card List')
                                    ->schema([
                                        Forms\Components\TextInput::make('receipt_quantity')
                                            ->label('Receipt Quantity')
                                            ->required()
                                            ->type('number')
                                            ->placeholder('Enter Receipt Quantity')
                                            ->rules('numeric', 'gt:0'),
                                        Forms\Components\DatePicker::make('date')
                                            ->label('Date')
                                            ->required()
                                            ->placeholder('Enter Date')
                                            ->rules('string', 'max:150'),
                                        Forms\Components\TextInput::make('reference')
                                            ->label('Reference')
                                            ->required()
                                            ->columnSpan(2)
                                            ->placeholder('Enter Reference')
                                            ->rules('string', 'max:150'),
                                        Forms\Components\TextInput::make('issue_quantity')
                                                    ->label('Issue Quantity')
                                                    ->required()
                                                    ->type('number')
                                                    ->placeholder('Enter Issue Quantity')
                                                    ->rules('numeric', 'gt:0'),
                                                Forms\Components\TextInput::make('issue_office')
                                                    ->label('Issue Office')
                                                    ->required()
                                                    ->placeholder('Enter Issue Office')
                                                    ->rules('string', 'max:150'),
                                                Forms\Components\TextInput::make('balance_quantity')
                                                    ->label('Balance Quantity')
                                                    ->required()
                                                    ->type('number')
                                                    ->placeholder('Enter Balance Quantity')
                                                    ->rules('numeric', 'gt:0'),
                                                Forms\Components\TextInput::make('no_of_days')
                                                    ->label('No. of Days to Consume')
                                                    ->required()
                                                    ->placeholder('Enter No of Days')
                                                    ->rules('string', 'max:150'),
                                ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('entity_name')
                ->label('Entity Name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('item_code')
                ->label('Item')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('stock_no')
                ->label('Stock No.')
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
                    Tables\Actions\Action::make('Download')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('primary')
                        ->url(fn(StockCard $record) => route('stock-card.pdf', $record))
                        ->openUrlInNewTab(),
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
            'index' => Pages\ListStockCards::route('/'),
            'create' => Pages\CreateStockCard::route('/create'),
            'edit' => Pages\EditStockCard::route('/{record}/edit'),
        ];
    }
}
