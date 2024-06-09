<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseRequestFormResource\Pages;
use App\Models\Project;
use App\Models\Purchase_Request_Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use App\Models\Purchase_Request_Items;
use Filament\Forms\Components\Wizard;

class PurchaseRequestFormResource extends Resource
{
    protected static ?string $model = Purchase_Request_Form::class;

    protected static ?string $modelItems = Purchase_Request_Items::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT (in-house)';

    protected static ?string $modelLabel = 'Purchase Request Form';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Purchase Request Form')
                        ->icon('heroicon-m-information-circle')
                        ->schema([
                            Select::make('project_id')
                                ->label('Project ID')
                                ->required()
                                ->options(
                                    Project::all()->mapWithKeys(function ($project) {
                                        return [$project->id => $project->id . ' - ' . $project->project_title];
                                    })->toArray()
                                ),
                            TextInput::make('pr_no')
                                ->label('PR No.')
                                ->rules(['regex:/^\d{3}-\d{4}-\d{2}-\d{2}-\d{2}$/'])
                                #->required()  
                                ->columnSpan(1)
                                ->placeholder('000-0000-00-00-00'),

                            DatePicker::make('date')
                                ->label('Date')
                                ->required()
                                //->default(now()->format('Y-m-d'))
                                //->readOnly()
                                ->columnSpan(1) 
                                ->placeholder('Enter Date'),

                            TextInput::make('section')
                                ->label('Section')
                                ->columnSpan(1)
                                ->placeholder('Enter Section'),

                            TextInput::make('sai_no')
                                ->label('SAI No.')
                                ->columnSpan(1)
                                ->rules(['regex:/^SAI-\d{5}$/'])
                                ->placeholder('SAI-00000'),

                            TextInput::make('bus_no')
                                ->label('Bus No.')
                                ->columnSpan(1)
                                ->rules(['regex:/^Bus-\d{5}$/'])
                                ->placeholder('Bus-00000'),

                        ]),
                    /*Wizard\Step::make('Items List')
                        ->icon('heroicon-m-list-bullet')
                        ->schema([
                            Repeater::make('purchase_request_items')
                            ->label('Add Items in Purchase Request Form')
                            ->columns(4)
                            ->relationship('purchase_request_items')
                            ->addActionLabel('Add Item')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => isset($state['item_no'], $state['item_description']) ? $state['item_no'] . ' - ' . $state['item_description'] : null)
                            ->schema([
                                TextInput::make('item_no')
                                    ->label('Item No.')
                                    ->type('number')
                                    ->columnSpan(1)
                                    ->required()
                                    ->unique()
                                    ->rules(['gt:0'])
                                    //->hint('Current Item No: ' . Purchase_Request_Items::max('item_no') + 1)
                                    ->placeholder('Item No. should be unique'),
                                TextInput::make('item_description')
                                    ->label('Item Description')
                                    ->required()
                                    ->rules(['string', 'max:150'])
                                    ->placeholder('Enter Item Description')
                                    ->columnSpan(2),
                                    TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->type('number')
                                    ->maxValue(9999999999999999)
                                    ->minValue(1)
                                    ->rules(['gt:0'])
                                    ->required()
                                    ->columnSpan(1)
                                    ->placeholder('Enter Quantity')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($get, $set, $old, $state) {
                                        $quantity = (float) $state;
                                        $estimateUnitCost = (float) $get('estimate_unit_cost');
                                        $estimateCost = number_format($quantity * $estimateUnitCost , 2, '.', '');
                                        $set('estimate_cost', $estimateCost);
                                    }),
                                Select::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->placeholder('Select Unit')
                                    ->columnSpan(1)
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
                                    ]),
                                TextInput::make('estimate_unit_cost')
                                    ->label('Estimated Unit Cost')
                                    ->type('number')
                                    ->step('0.01') 
                                    ->required()
                                    ->rules(['gt:0.00'])
                                    ->prefix('₱')
                                    ->columnSpan(1)
                                    ->placeholder('Enter Estimated Unit Cost')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function ($get, $set, $old, $state) {
                                        $quantity = (float) $get('quantity');
                                        $estimateUnitCost = (float) $get('estimate_unit_cost');
                                        $estimateCost = number_format($quantity * $estimateUnitCost, 2, '.', '');
                                        $set('estimate_cost', $estimateCost);
                                    }),
  
                                TextInput::make('estimate_cost')
                                    ->label('Estimated Cost')
                                    ->required()
                                    ->prefix('₱')
                                    ->rules(['gt:0.00'])
                                    ->columnSpan(2)
                                    ->type('number') 
                                    ->step('0.01') 
                                    #->live(onBlur: true)
                                    ->readOnly()
                                    ->placeholder('Enter Estimated Cost'),
                                   # ->extraAttributes([
                                    #    'min' => 0,
                                    #    'max' => 9999999999999999.99,
                                   #     'pattern' => '\d+(\.\d{2})?',
                                    #]),
                        ]),
                    ]),
                    Wizard\Step::make('Total and Other Information')
                        ->icon('heroicon-m-banknotes')
                        ->schema([
                            Select::make('calculate')  // This is where the button goes
                            ->label('Calculate Total Automatically?')
                            ->reactive()
                            #->default('Yes')
                            ->options([
                                'Yes' => 'Yes',
                                'No' => 'No',
                            ])
                            ->afterStateUpdated(function ($get, $set, $state) {
                                if ($state === 'Yes') {
                                    $total = 0;
                                    $items = $get('purchase_request_items');

                                    foreach ($items as $item) {
                                        $total += (float) str_replace('₱', '', $item['estimate_cost']);
                                    }

                                    $set('total', number_format($total, 2, '.', ''));
                                } elseif ($state === 'No') {
                                    $set('total', null);
                                }

                            }),
                            TextInput::make('total')
                                ->label('Total')
                                ->columnSpan(2)
                                ->rules(['gt:0.00'])
                                ->type('number') 
                                ->step('0.01') 
                                ->prefix('₱')
                                ->required()
                                ->live(onBlur: true)
                                ->placeholder('Enter Total')
                                ->extraAttributes([
                                    'min' => 0,
                                    'max' => 9999999999999999.99,
                                    'pattern' => '\d+(\.\d{2})?'
                                ]),
                            TextInput::make('delivery_duration')
                                ->label('Delivery Duration')
                                ->required()
                                ->columnSpan(2)
                                ->rules(['string', 'max:50'])
                                ->placeholder('Enter Delivery Duration'),
                            TextInput::make('purpose')
                                ->label('Purpose')
                                ->required()
                                ->columnSpan(2)
                                ->rules(['string', 'max:150'])
                                ->placeholder('Enter Purpose'),
                    ]),*/
                    Wizard\Step::make('Signatories')
                        ->icon('heroicon-m-user-circle')
                        ->schema([
                            TextInput::make('recommended_by_name')
                                ->label('Recommended By Name')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Recommended By Name'),
                            TextInput::make('recommended_by_designation')
                                ->label('Recommended By Designation')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Recommended By Designation'),
                            TextInput::make('approved_by_name') 
                                ->label('Approved By Name')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Approved By Name'),
                            TextInput::make('approved_by_designation')
                                ->label('Approved By Designation')
                                ->required()
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Approved By Designation'),
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
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.project_title')
                    ->label('Project Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.department')
                    ->label('Department/Office')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('pr_no')
                    ->label('PR No.')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->searchable()
                    ->dateTime()
                    ->sortable(),

            ])
            ->filters([
                
                
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
                        ->url(fn(Purchase_Request_Form $record) => route('purchase-request.pdf', $record))
                        ->openUrlInNewTab(),
                    ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPurchaseRequestForms::route('/'),
            'create' => Pages\CreatePurchaseRequestForm::route('/create'),
            'edit' => Pages\EditPurchaseRequestForm::route('/{record}/edit'),
        ];
    }    
}
