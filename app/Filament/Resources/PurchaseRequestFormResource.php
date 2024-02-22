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


class PurchaseRequestFormResource extends Resource
{
    protected static ?string $model = Purchase_Request_Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';
    protected static ?string $modelLabel = 'Purchase Request Forms';


    public static function form(Form $form): Form
    {
        //$repeatableFields = array_merge(...$repeatableFields);

        return $form
            ->schema([
                Select::make('project_id')
                    ->label('Project ID')
                    ->columnSpan(3)
                    ->required()
                    ->options(
                        Project::all()->mapWithKeys(function ($project) {
                            return [$project->id => $project->id . ' - ' . $project->project_title];
                        })->toArray()
                    ),
                /*TextInput::make('project_title')
                    ->label('Project Title')
                    ->columnSpan(3)
                    ->required()
                    ->autofocus()   
                    ->placeholder('Enter Project Title'),
                Select::make('department')
                    ->label('Department/Office')
                    ->required()
                    ->options([
                        'PFMO' => 'PFMO',
                        'PSO' => 'PSO',
                        // Add more options as needed
                    ])
                    ->placeholder('Select Department/Office'),*/
                TextInput::make('pr_no')
                    ->label('PR No.')
                    ->required()  
                    ->rules(['regex:/^PR-\d{4}$/'])
                    ->placeholder('Format: PR-0000'),

                DatePicker::make('date')
                    ->label('Date')
                    ->required()
                    ->columnSpan(3) 
                    ->placeholder('Enter Date'),

                TextInput::make('section')
                    ->label('Section')
                    ->placeholder('Enter Section'),

                TextInput::make('sai_no')
                    ->label('SAI No.')
                    ->rules(['regex:/^SAI-\d{5}$/'])
                    ->placeholder('Format: SAI-00000'),

                TextInput::make('bus_no')
                    ->label('Bus No.')
                    ->rules(['regex:/^Bus-\d{5}$/'])
                    ->placeholder('Format: Bus-00000'),
                
                    Select::make('unit')
                    ->label('Unit')
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
                        ->columnSpan(3),
                    TextInput::make('quantity')
                        ->label('Quantity')
                        ->type('number')
                        ->required()
                        ->placeholder('Enter Quantity'),

                    TextInput::make('estimate_unit_cost')
                        ->label('Estimate Unit Cost')
                        ->type('number') // Use text type for decimal numbers
                        ->step('0.01') // Specify the precision of the decimal
                        ->required()
                        ->placeholder('Enter Estimate Unit Cost'),
                    
                    TextInput::make('estimate_cost')
                        ->label('Estimate Cost')
                        ->required()
                        ->type('text') // Use text type for decimal numbers
                        ->step('0.01') // Specify the precision of the decimal
                        ->placeholder('Enter Estimate Cost')
                        ->extraAttributes([
                            'min' => 0,
                            'max' => 9999999999999999.99,
                            'pattern' => '\d+(\.\d{2})?',
                        ]),
                    TextInput::make('total')
                        ->label('Total')
                        ->type('text') // Use text type for decimal numbers
                        ->step('0.01') // Specify the precision of the decimal
                        ->required()
                        ->placeholder('Enter Total')
                        ->extraAttributes([
                            'min' => 0,
                            'max' => 9999999999999999.99,
                            'pattern' => '\d+(\.\d{2})?',
                        ]),

                TextInput::make('delivery_duration')
                    ->label('Delivery Duration')
                    ->required()
                    ->placeholder('Enter Delivery Duration'),

                TextInput::make('purpose')
                    ->label('Purpose')
                    ->required()
                    ->placeholder('Enter Purpose'),

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

            ])->columns(7);
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
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section')
                    ->label('Section')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sai_no')
                    ->label('SAI No.')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bus_no')
                    ->label('Bus No.')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('unit')
                    ->label('Unit')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item_description')
                    ->label('Item Description')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->label('Quantity')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimate_unit_cost')
                    ->label('Estimate Unit Cost')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimate_cost')
                    ->label('Estimate Cost')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('delivery_duration')
                    ->label('Delivery Duration')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->label('Purpose')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('recommended_by_name')
                    ->label('Recommended By Name')
                    ->searchable()
                    ->sortable(),  
                Tables\Columns\TextColumn::make('recommended_by_designation')
                    ->label('Recommended By Designation')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('approved_by_name')
                    ->label('Approved By Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('approved_by_designation')
                    ->label('Approved By Designation')
                    ->searchable()
                    ->sortable(),
                
            ])
            ->filters([
                
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Download')
                        ->icon('heroicon-o-rectangle-stack')
                        ->url(fn(Purchase_Request_Form   $record) => route('download.purchase.request.pdf', $record))
                        ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
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
