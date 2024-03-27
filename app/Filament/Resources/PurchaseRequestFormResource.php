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

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    protected static ?string $modelLabel = 'Purchase Request Forms';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        //$repeatableFields = array_merge(...$repeatableFields);

        return $form
            ->schema([
            Fieldset::make('Purchase Request Form')
                ->columns(5)
                ->schema([
                Select::make('project_id')
                    ->label('Project ID')
                    ->columnSpan(1)
                    ->required()
                    ->options(
                        Project::all()->mapWithKeys(function ($project) {
                            return [$project->id => $project->id . ' - ' . $project->project_title];
                        })->toArray()
                    ),
                TextInput::make('pr_no')
                    ->label('PR No.')
                   // ->rules(['gt:000-0000-00-00-00'])
                    ->required()  
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

                TextInput::make('total')
                    ->label('Total')
                    ->columnSpan(1)
                    ->rules(['gt:0.00'])
                    ->type('number') // Use text type for decimal numbers
                    ->step('0.01') // Specify the precision of the decimal
                    ->required()
                    // ->evaluate(function ($record) {
                    //     return Purchase_Request_Items::where('purchase_request_form_id', $record->id)->sum('estimate_cost');
                    // })
                    ->placeholder('Enter Total')
                    ->extraAttributes([
                        'min' => 0,
                        'max' => 9999999999999999.99,
                        'pattern' => '\d+(\.\d{2})?'
                    ]),

                TextInput::make('delivery_duration')
                    ->label('Delivery Duration')
                    ->required()
                    ->placeholder('Enter Delivery Duration'),
    
                TextInput::make('purpose')
                    ->label('Purpose')
                    ->required()
                    ->columnSpan(2)
                    ->placeholder('Enter Purpose'),
                ]),
            Fieldset::make('Signatories')
                ->schema([
                TextInput::make('recommended_by_name')
                    ->label('Recommended By Name')
                    ->required()
                    ->placeholder('Enter Recommended By Name'),
    
                TextInput::make('recommended_by_designation')
                    ->label('Recommended By Designation')
                    ->required()
                    ->placeholder('Enter Recommended By Designation'),
    
                TextInput::make('approved_by_name') //pwede gawing dropdown
                    ->label('Approved By Name')
                    ->required()
                    ->placeholder('Enter Approved By Name'),
    
                TextInput::make('approved_by_designation')
                    ->label('Approved By Designation')
                    ->required()
                    ->placeholder('Enter Approved By Designation'),
                ]),
            Fieldset::make('Add Items in Purchase Request Form')
                    ->columns(1)
                    ->schema([
                        Repeater::make('purchase_request_items')
                            ->label('Items List')
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
                                    ->live()
                                    ->rules(['gt:0'])
                                    ->hint('Current Item No: ' . Purchase_Request_Items::max('item_no') + 1)
                                    ->placeholder('Enter Item No'),

                                Select::make('unit')
                                    ->label('Unit')
                                    ->required()
                                    ->placeholder('Select Unit')
                                    ->live()
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
                                    ->live()
                                    ->placeholder('Enter Item Description')
                                    ->columnSpan(2),
                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->type('number')
                                    ->live()
                                    ->maxValue(9999999999999999)
                                    ->minValue(1)
                                    ->rules(['gt:0'])
                                    ->required()
                                    ->columnSpan(1)
                                    ->placeholder('Enter Quantity'),

                                TextInput::make('estimate_unit_cost')
                                    ->label('Estimate Unit Cost')
                                    ->type('number') // Use text type for decimal numbers
                                    ->step('0.01') // Specify the precision of the decimal
                                    ->required()
                                    ->live()
                                    ->rules(['gt:0.00'])
                                    ->columnSpan(1)
                                    ->placeholder('Enter Estimate Unit Cost'),
                                
                                TextInput::make('estimate_cost')
                                    ->label('Estimate Cost')
                                    ->required()
                                    ->live()
                                    ->rules(['gt:0.00'])
                                    ->columnSpan(2)
                                    ->type('number') // Use text type for decimal numbers
                                    ->step('0.01') // Specify the precision of the decimal
                                    ->placeholder('Enter Estimate Cost')
                                    ->extraAttributes([
                                        'min' => 0,
                                        'max' => 9999999999999999.99,
                                        'pattern' => '\d+(\.\d{2})?',
                                    ]),
                                ]),
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
                        ->url(fn(Purchase_Request_Form $record) => route('purchase-request.pdf', $record->pr_no))
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
