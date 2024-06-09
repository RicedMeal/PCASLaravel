<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketStudiesResource\Pages;
use App\Filament\Resources\MarketStudiesResource\RelationManagers;
use App\Models\MarketStudies;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\FormsComponent;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\IconPosition;

class MarketStudiesResource extends Resource
{
    protected static ?string $model = MarketStudies::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-magnifying-glass';

    protected static ?string $modelLabel = 'Market Studies';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT (in-house)';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Market Studies Information')
                    ->icon('heroicon-m-information-circle')
                    ->iconPosition(IconPosition::Before)
                    ->collapsible()
                    ->columns(4)
                    ->description('Fill the necessary information for the Market Studies. The Average Sub-Total will be calculated automatically.')
                    ->schema([
                        Select::make('project_id')
                            ->label('Project ID')
                            ->required()
                            ->placeholder('Select Project ID')
                            ->options(
                                Project::all()->mapWithKeys(function ($project) {
                                    return [$project->id => $project->id . ' - ' . $project->project_title];
                                })->toArray()
                            ),

                        TextInput::make('end_user')
                            #->readonly()
                            ->label('Person in Charge'),
                            #->default(function () {
                            #    return auth()->user()->name;
                            #}),

                        TextInput::make('abc')
                            ->label('ABC')
                            ->placeholder('From Annual Procurement Plan')
                            ->prefix('₱')
                            ->rules('numeric', 'gt:0.00'),
                            
                        TextInput::make('average_subtotal')
                            ->label('Average Sub-Total')
                            ->prefix('₱')
                            ->rules('numeric', 'gt:0.00')
                            ->helperText('Do not fill this field. Automatically calculated.')
                            ->readonly(),
                    ]),
                Section::make('Market Studies Items')
                    ->icon('heroicon-m-list-bullet')
                    ->iconPosition(IconPosition::Before)
                    ->collapsible()
                    ->description('Add items for the Market Studies and fill the necessary information. The Average Unit Price and Average Amount will be calculated automatically.')
                    ->schema([
                        Repeater::make('market_studies_items')
                            ->label('Items Information')
                            ->columns(4)
                            ->relationship('market_studies_items')
                            ->addActionLabel('Add Item')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => isset($state['item_no'], $state['particulars']) ? $state['item_no'] . ' - ' . $state['particulars'] : null)
                            ->schema([
                                TextInput::make('item_no')
                                    ->label('Item No')
                                    ->helperText('Filled by the User')
                                    ->required()
                                    ->type('number')
                                    ->columnSpan(1)
                                    ->unique()
                                    ->rules(['gt:0'])
                                    //->hint('Current Item No: ' . Purchase_Request_Items::max('item_no') + 1)
                                    ->placeholder('Item No. should be unique'),

                                TextInput::make('particulars')
                                    ->label('Particulars')
                                    ->rules('string', 'max:150')
                                    ->placeholder('Enter Particulars')
                                    ->helperText('Description or Name of the Item.')
                                    ->columnSpan(3)
                                    ->required(),

                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->placeholder('Enter Quantity')
                                    ->type('number')
                                    ->rules('numeric', 'gt:0')
                                    ->helperText('How many are needed?')
                                    ->required(),

                                Select::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->columnSpan(1)
                                    ->placeholder('Select Unit')
                                    ->options([
                                        'box' => 'box',
                                        'length' => 'length',
                                        'lot' => 'lot',
                                        'pack' => 'pack',
                                        'pcs.' => 'pcs.',
                                        'ream' => 'ream',
                                        'roll' => 'roll',
                                        'set' => 'set',
                                        'unit' => 'unit',
                                    ])
                                    ->helperText('Unit of the Item'),
                                
                                TextInput::make('average_unit_price')
                                    ->label('Average Unit Price')
                                    ->prefix('₱')
                                    ->readonly()
                                    ->helperText('Do not fill this field. Automatically calculated.')
                                    ->rules('numeric', 'gt:0.00'),
                                
                                TextInput::make('average_amount')
                                    ->label('Average Amount')
                                    ->prefix('₱')
                                    ->helperText('Do not fill this field. Automatically calculated.')
                                    ->rules('numeric', 'gt:0.00')
                                    ->readonly(),
                                    // ->default(function (FormsComponent $component) {
                                    //     return $component->getForm()->getComponent('quantity')->getValue($component) * $component->getForm()->getComponent('unit_price')->getValue($component);
                                    // }),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('market_studies_items.item_no')
                    ->label('Item No')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('market_studies_items.particulars')
                    ->label('Particulars')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('market_studies_items.average_unit_price')
                    ->label('Average Unit Price')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('market_studies_items.average_amount')
                    ->label('Average Amount')
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
                    ]),
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
            //RelationManagers\MarketStudiesItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarketStudies::route('/'),
            'create' => Pages\CreateMarketStudies::route('/create'),
            'edit' => Pages\EditMarketStudies::route('/{record}/edit'),
        ];
    }
}
