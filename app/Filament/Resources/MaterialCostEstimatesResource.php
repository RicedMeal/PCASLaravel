<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialCostEstimatesResource\Pages;
use App\Models\MaterialCostEstimates;
use App\Models\MaterialCostEstimatesItems;
use App\Models\Project;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\DatePicker;


class MaterialCostEstimatesResource extends Resource
{
    protected static ?string $model = MaterialCostEstimates::class;
    
    protected static ?string $modelItems = MaterialCostEstimatesItems::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT (in-house)';

    protected static ?string $modelLabel = 'Material Cost Estimates Form';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Material and Cost Estimates Form')
                        ->schema([
                            Select::make('project_id')
                            ->label('Project ID')
                            ->required()
                            ->options(
                                Project::all()->mapWithKeys(function ($project) {
                                    return [$project->id => $project->id . ' - ' . $project->project_title];
                                })->toArray()
                            ),
                            TextInput::make('location')
                            ->label('Location')
                            ->required()
                            ->rules(['string', 'max:100'])
                            ->placeholder('Enter Location'),
                        ]),
                    Wizard\Step::make('Add Material and Cost Estimates Items')
                        ->schema([
                            Repeater::make('material_cost_estimates_items')
                            ->label('Items List')
                            ->columns(4)
                            ->relationship('material_cost_estimates_items')
                            ->addActionLabel('Add Item')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['item_no'] ?? null)
                            ->schema([
                                TextInput::make('item_no')
                                    ->label('Item No.')
                                    ->required()
                                    //->unique()
                                    ->type('number')
                                    ->columnSpan(1)
                                    ->rules(['gt:0']),  
                                    #->placeholder('Item No. should be unique')
                                TextInput::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->columnSpan(3)
                                    ->rules(['string', 'max:255'])
                                    ->placeholder('Enter Description'),
                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->required()
                                    ->type('number')
                                    ->rules(['gt:0'])
                                    ->columnSpan(1)
                                    ->placeholder('Enter Quantity')
                                    ->live(debounce: 500)
                                    #->reactive()
                                    /*->afterStateUpdated(function ($get, $set, $old, $state) {
                                        $quantity = (float) $state;
                                        $unitCost = (float) $get('unit_cost');
                                        $amount = number_format($quantity * $unitCost , 2, '.', '');
                                        $set('amount', $amount);
                                    })*/,
                                Select::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->columnSpan(1)
                                    ->placeholder('Enter Unit')
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
                                TextInput::make('unit_cost')
                                    ->label('Unit Cost')
                                    ->required()
                                    ->type('number')
                                    ->prefix('₱')
                                    ->columnSpan(1)
                                    ->placeholder('Enter Unit Cost')
                                    ->live(onBlur: true)
                                    #->reactive()
                                    ->afterStateUpdated(function ($get, $set, $old, $state) {
                                        $quantity = (float) $get('quantity');
                                        $unitCost = (float) $get('unit_cost');
                                        $amount = number_format($quantity * $unitCost, 2, '.', '');
                                        $set('amount', $amount);
                                    }),
                                TextInput::make('amount')
                                    ->label('Amount')
                                    ->live(onBlur: true)
                                    #->reactive()
                                    ->required()
                                    ->prefix('₱')
                                    ->type('number')
                                    ->step('0.01') 
                                    ->rules(['gt:0.00'])
                                    ->columnSpan(1),
                            ]),


                            TextInput::make('total')
                                    #->readOnly()
                                    ->label('Total')
                                    ->required()
                                    ->type('number')
                                    ->step('0.01') 
                                    ->prefix('₱')
                                    ->rules(['gt:0.00'])
                                    ->placeholder('Input any number to compute the total amount of the items list.')
                                    ->live(debounce: 500)
                                    #->reactive()
                                    ->afterStateUpdated(function ($get, $set, $old, $state) {
                                        $total = 0;
                                        $items = $get('material_cost_estimates_items');

                                        foreach ($items as $item) {
                                            $total += (float) str_replace('₱', '', $item['amount']);
                                        }
                                        $set('total', number_format($total, 2, '.', ''));
                                    }),
                                    
                    ]),
                    Wizard\Step::make('Signatories')
                        ->schema([
                            TextInput::make('prepared_by')
                                ->label('Prepared By:')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Name'),
                            TextInput::make('prepared_by_designation')
                                ->label('Prepared By Designation:')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Designation'),
                            TextInput::make('checked_by')
                                ->label('Checked By:')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Name'),
                            TextInput::make('checked_by_designation')
                                ->label('Checked By Designation:')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Designation')
                    ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_id')
                    ->label('Project ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Created')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.project_title')
                    ->label('Project Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.department')
                    ->label('Department/Office')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->searchable()
                    ->sortable(),
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
                    ->url(fn(MaterialCostEstimates $record) => route('material-cost-estimates.pdf', $record))
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
            'index' => Pages\ListMaterialCostEstimates::route('/'),
            'create' => Pages\CreateMaterialCostEstimates::route('/create'),
            'edit' => Pages\EditMaterialCostEstimates::route('/{record}/edit'),
        ];
    }
}
