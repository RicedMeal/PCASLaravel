<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PFMOSuppliesResource\Pages;
use App\Filament\Resources\PFMOSuppliesResource\RelationManagers;
use App\Models\PFMO_Supplies;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PFMOSuppliesResource extends Resource
{
    protected static ?string $model = PFMO_Supplies::class;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $modelLabel = 'PFMO Supplies';

    protected static ?string $label = 'Projects';

    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('PFMO Supplies Information')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('user')
                            ->default(function () {
                              return auth()->user()->name;
                            })
                            ->readOnly()
                            ->required(),
                        Forms\Components\DatePicker::make('entry_date')
                            ->required()
                            ->label('Entry Date')
                            ->helperText('Choose the entry date. The Custom Code will be generated automatically.'),

                        Forms\Components\TextInput::make('custom_code')
                            ->disabled(true)
                            ->label('Custom Code')
                            ->helperText('This field is automatically generated and not editable.'),
                    ]),
                Forms\Components\Section::make('PFMO Supplies List')
                    ->schema([
                Forms\Components\Repeater::make('pfmo_supplies_list')
                    ->label('Supplies Information')
                    ->columns(3)
                    ->relationship('pfmo_supplies_list')
                    ->reorderableWithButtons()
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['stock_no'] ?? null)
                    ->addActionLabel('Add Supply')
                    ->schema([
                        Forms\Components\TextInput::make('stock_no')
                            ->label('Stock No.')
                            ->helperText('Example: 2024-000001')
                            ->rules(['regex:/^\d{4}-\d{6}$/'])
                            ->placeholder('0000-000000')
                            ->required(),
                        Forms\Components\Select::make('unit')
                            ->label('Unit')
                            ->helperText('Choose the unit of the supply. e.g. length')
                            ->required()
                            ->rules(['string', 'max:150'])
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
                        Forms\Components\TextInput::make('quantity')
                            ->label('Quantity')
                            ->required()
                            ->type('number')
                            ->placeholder('Enter Quantity')
                            ->maxValue(9999999999999999)
                            ->minValue(1)
                            ->rules(['gt:0'])
                            ->type('number'),
                        Forms\Components\TextInput::make('description')
                            ->columnSpan(3)
                            ->label('Description')
                            ->rules(['string', 'max:150'])
                            ->placeholder('Enter Supply Description')
                            ->required(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('custom_code')
                    ->label('Custom ID')
                    ->searchable()
                    ->sortable(), // If you need the column to be sortable
                Tables\Columns\TextColumn::make('entry_date')
                    ->sortable()
                    ->searchable()
                    ->label('Entry Date')
                    ->date(), // Format this as a date, or use ->dateTime() as needed
                Tables\Columns\TextColumn::make('user')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
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
                        ->url(fn(PFMO_Supplies $record) => route('pfmo_supplies.pdf', $record))
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
            'index' => Pages\ListPFMOSupplies::route('/'),
            'create' => Pages\CreatePFMOSupplies::route('/create'),
            'edit' => Pages\EditPFMOSupplies::route('/{record}/edit'),
        ];
    }
}
