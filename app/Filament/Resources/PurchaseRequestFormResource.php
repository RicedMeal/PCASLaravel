<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PurchaseRequestFormResource\Pages;
use App\Filament\Resources\PurchaseRequestFormResource\RelationManagers;
use App\Models\Project;
use App\Models\Purchase_Request_Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Fieldset;
use Illuminate\Http\Request;
use App\Http\Controllers\PurchaseRequestItemsController;
use App\Models\Purchase_Request_Items;

class PurchaseRequestFormResource extends Resource
{
    protected static ?string $model = Purchase_Request_Form::class;

    protected static ?string $modelItems = Purchase_Request_Items::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    protected static ?string $modelLabel = 'Purchase Request Forms';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
            Fieldset::make('Purchase Request Form')
                ->columns(3)
                ->columnSpan(20)
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
                    ->required()  
                    ->unique()
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
            Fieldset::make('Signatories')
                ->columns(4)
                ->columnSpan(20)
                ->schema([
                TextInput::make('recommended_by_name')
                    ->label('Recommended By Name')
                    ->required()
                    ->placeholder('Enter Recommended By Name'),
    
                TextInput::make('recommended_by_designation')
                    ->label('Recommended By Designation')
                    ->required()
                    ->placeholder('Enter Recommended By Designation'),
    
                TextInput::make('approved_by_name') 
                    ->label('Approved By Name')
                    ->required()
                    ->placeholder('Enter Approved By Name'),
    
                TextInput::make('approved_by_designation')
                    ->label('Approved By Designation')
                    ->required()
                    ->placeholder('Enter Approved By Designation'),
                ]),
            Fieldset::make('Items List')
                    ->columns(1)
                    ->columnSpan(20)
                    ->schema([
                        Repeater::make('purchase_request_items')
                            ->label('Add Items in Purchase Request Form')
                            ->columns(4)
                            ->relationship('purchase_request_items')
                            ->addActionLabel('Add Item')
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['item_no'] ?? null)
                            ->schema([
                                TextInput::make('item_no')
                                    ->label('Item No.')
                                    ->type('number')
                                    ->columnSpan(1)
                                    ->required()
                                    ->rules(['gt:0', 'unique:purchase_request_items,item_no'])
                                    ->hint('Current Item No: ' . Purchase_Request_Items::max('item_no') + 1)
                                    ->placeholder('Enter Item No'),

                                Select::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->placeholder('Select Unit')
                                    ->columnSpan(1)
                                    ->options([
                                        'unit' => 'unit',
                                        'lot' => 'lot',
                                        'set' => 'set',
                                        'pc.' => 'pc.',
                                        'length' => 'length',
                                        'box' => 'box',
                                        'roll' => 'roll',
                                        'pack' => 'pack',
                                        'ream' => 'ream',
                                    ]),
                                TextInput::make('item_description')
                                    ->label('Item Description')
                                    ->required()
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
                                    ->placeholder('Enter Quantity'),

                                TextInput::make('estimate_unit_cost')
                                    ->label('Estimate Unit Cost')
                                    ->type('number') //use text type for decimal numbers
                                    ->step('0.01') //specify the precision of the decimal
                                    ->required()
                                    ->rules(['gt:0.00'])
                                    ->prefix('₱')
                                    ->columnSpan(1)
                                    ->placeholder('Enter Estimate Unit Cost'),
                                
                                TextInput::make('estimate_cost')
                                    ->label('Estimate Cost')
                                    ->required()
                                    ->prefix('₱')
                                    ->rules(['gt:0.00'])
                                    ->columnSpan(2)
                                    ->type('number') 
                                    ->step('0.01') 
                                    ->placeholder('Enter Estimate Cost')
                                    ->extraAttributes([
                                        'min' => 0,
                                        'max' => 9999999999999999.99,
                                        'pattern' => '\d+(\.\d{2})?',
                                    ]),
                                ]),
                    ]),
                    Fieldset::make('Total and Other Information')
                    ->columns(4)
                    ->columnSpan(20)
                    ->schema([
                        TextInput::make('total')
                            ->label('Total')
                            ->columnSpan(1)
                            ->rules(['gt:0.00'])
                            ->type('number') 
                            ->step('0.01') 
                            ->prefix('₱')
                            ->required()
                            ->placeholder('Enter Total')
                            ->extraAttributes([
                                'min' => 0,
                                'max' => 9999999999999999.99,
                                'pattern' => '\d+(\.\d{2})?'
                            ]),
                        TextInput::make('delivery_duration')
                            ->label('Delivery Duration')
                            ->required()
                            ->columnSpan(1)
                            ->placeholder('Enter Delivery Duration'),
                        TextInput::make('purpose')
                            ->label('Purpose')
                            ->required()
                            ->columnSpan(2)
                            ->placeholder('Enter Purpose'),
                    ]),
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
                    ->sortable(),

            ])
            ->filters([
                
                
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Download')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->url(fn(Purchase_Request_Form $record) => route('purchase-request.pdf', $record))
                        ->openUrlInNewTab(),
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
