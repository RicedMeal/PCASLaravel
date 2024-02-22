<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbstractOfCanvassResource\Pages;
use App\Filament\Resources\AbstractOfCanvassResource\RelationManagers;
use App\Models\Abstract_of_Canvass_Form;
use App\Models\AbstractOfCanvass;
use App\Models\Project;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use IntlChar;
use Filament\Tables\Columns\TextColumn;

class AbstractOfCanvassResource extends Resource
{
    protected static ?string $model = Abstract_of_Canvass_Form::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';
    protected static ?string $modelLabel = 'Abstract of Canvass Form';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->label('Project Title')
                    ->columnSpan(3)
                    ->required()
                    ->options(
                        Project::all()->mapWithKeys(function ($project) {
                            return [$project->id => $project->id . ' - ' . $project->project_title];
                        })->toArray()
                    ),
                /*TextInput::make('project_title')
                ->required()
                ->autofocus()
                ->columnSpan(3)
                ->placeholder('Enter Project Title'),*/     
                
                TextInput::make('approved_budget_contract')
                ->required()
                ->columnSpan(3) 
                ->placeholder('Enter Approved Budget Contract')
                ->prefix('₱')
                ->type('number')
                ->step('0.01')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]),
                
                /*Select::make('end_user')
                ->required()
                ->options([
                    'PFMO' => 'PFMO',
                    'PSO' => 'PSO',
                ])
                ->placeholder('Select End User')
                ->label('End-User'),*/

                TextInput::make('particulars')
                ->required()
                ->placeholder('Enter Particulars')
                ->columnSpan(3)
                ->label('Particulars'),

                TextInput::make('quantity')
                ->required()
                ->placeholder('Enter Quantity')
                ->label('Quantity')
                ->type('number'),

                Select::make('unit')
                ->required()
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
                ])
                ->placeholder('Select Unit')
                ->label('Unit'),

                TextInput::make('abc_in_table')
                ->label('ABC in Table')
                ->placeholder('Enter ABC in Table'),

                TextInput::make('supplier_company_name')
                ->label('Supplier Company Name')
                ->placeholder('Enter Supplier Company Name')
                ->required()
                ->columnSpan(3),

                TextInput::make('supplier_address')
                ->label('Supplier Address')
                ->placeholder('Enter Supplier Address')
                ->required()
                ->columnSpan(3),

                TextInput::make('supplier_contact_no')
                ->label('Supplier Contact No.')
                ->placeholder('Enter Supplier Contact No.')
                ->required()
                ->type('phone'),

                TextInput::make('unit_price_each_supplier')
                ->type('number') // Use text type for decimal numbers
                ->step('0.01') // Specify the precision of the decimal
                ->label('Unit Price Each Supplier') // Use text type for decimal numbers    
                ->placeholder('Enter Unit Price Each Supplier')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]),

                TextInput::make('amount_each_supplier')
                ->label('Amount Each Supplier') 
                ->type('text') // Use text type for decimal numbers
                ->step('0.01') // Specify the precision of the decimal
                ->placeholder('Enter Amount Each Supplier')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]),

                TextInput::make('sub_total_each_supplier')
                ->required()
                ->label('Sub Total Each Supplier')
                ->type('text') // Use text type for decimal numbers
                ->step('0.01') // Specify the precision of the decimal
                ->placeholder('Enter Sub Total Each Supplier')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]),

                TextInput::make('unit_price_average')
                ->required()
                ->label('Unit Price Average')
                ->type('text') // Use text type for decimal numbers
                ->step('0.01') // Specify the precision of the decimal
                ->placeholder('Enter Unit Price Average')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]),

                TextInput::make('amount_average')
                ->required()
                ->label('Amount Average')
                ->type('text') // Use text type for decimal numbers
                ->step('0.01') // Specify the precision of the decimal
                ->placeholder('Enter Amount Average')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]),

                TextInput::make('sub_total_average')
                ->required()
                ->label('Sub Total Average')
                ->type('text') // Use text type for decimal numbers
                ->step('0.01') // Specify the precision of the decimal
                ->placeholder('Enter Sub Total Average')
                ->extraAttributes([
                    'min' => 0,
                    'max' => 9999999999999999.99,
                    'pattern' => '\d+(\.\d{2})?',
                ]), 

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_id')
                    ->label('Project ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('project.project_title')
                    ->label('Project Title')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('approved_budget_contract')
                    ->label('Approved Budget Contract')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('particulars')
                    ->label('Particulars')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('unit')
                    ->label('Unit')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('abc_in_table')
                    ->label('ABC in Table')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('supplier_company_name')
                    ->label('Supplier Company Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('supplier_address')
                    ->label('Supplier Address')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('supplier_contact_no')
                    ->label('Supplier Contact No.')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('unit_price_each_supplier')
                    ->label('Unit Price Each Supplier')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount_each_supplier')
                    ->label('Amount Each Supplier')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sub_total_each_supplier')
                    ->label('Sub Total Each Supplier')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('unit_price_average')
                    ->label('Unit Price Average')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount_average')
                    ->label('Amount Average')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sub_total_average')
                    ->label('Sub Total Average')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Download')
                    ->icon('heroicon-o-rectangle-stack')
                    ->url(fn(Abstract_of_Canvass_Form $record) => route('download.abstract.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([

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
            'index' => Pages\ListAbstractOfCanvasses::route('/'),
            'create' => Pages\CreateAbstractOfCanvass::route('/create'),
            'edit' => Pages\EditAbstractOfCanvass::route('/{record}/edit'),
        ];
    }    
}
