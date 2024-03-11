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
use App\Models\Abstract_of_Canvass_Items;
use Filament\Forms\Components\FieldSet;
use Filament\Forms\Components\Repeater;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneInputNumberType;


class AbstractOfCanvassResource extends Resource
{
    protected static ?string $model = Abstract_of_Canvass_Form::class;
    protected static ?string $modelItems = Abstract_of_Canvass_Items::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';
    protected static ?string $modelLabel = 'Abstract of Canvass Form';

    public static function form(Form $form): Form
    {
            return $form
                ->schema([
                    FieldSet::make('Abstract of Canvass Form')
                        ->columns(3)
                        ->schema([
                            Select::make('project_id')
                                ->label('Project Title')
                                ->columnSpan(1)
                                ->required()
                                ->options(
                                    Project::all()->mapWithKeys(function ($project) {
                                        return [$project->id => $project->id . ' - ' . $project->project_title];
                                    })->toArray()
                                ),
    
                            TextInput::make('approved_budget_contract')
                                ->required()
                                ->columnSpan(1)
                                ->placeholder('Enter Approved Budget Contract')
                                ->prefix('₱')
                                ->type('number')
                                ->rules(['gt:0.00'])
                                ->step('0.01')
                                ->extraAttributes([
                                    'min' => 0,
                                    'max' => 9999999999999999.99,
                                    'pattern' => '\d+(\.\d{2})?',
                                ]),
    
                            TextInput::make('supplier_company_name')
                                ->label('Supplier Company Name')
                                ->placeholder('Enter Supplier Company Name')
                                ->required()
                                ->columnSpan(1),
    
                            TextInput::make('supplier_address')
                                ->label('Supplier Address')
                                ->placeholder('Enter Supplier Address')
                                ->required()
                                ->columnSpan(1),
    
                            PhoneInput::make('supplier_contact_no')
                                ->label('Supplier Contact No.')
                                ->placeholder('Enter Supplier Contact No.')
                                ->required()
                                ->initialCountry('ph'),
                            
                            TextInput::make('sub_total_each_supplier')
                                ->label('Sub Total Each Supplier')
                                ->placeholder('Enter Sub Total For Each Supplier')
                                ->required()
                                ->rules(['gt:0.00'])
                                ->columnSpan(1)
                                ->type('number')
                                ->step('0.01')
                                ->extraAttributes([
                                    'min' => 0,
                                    'max' => 9999999999999999.99,
                                    'pattern' => '\d+(\.\d{2})?',
                                ]),
                    ]),
    
                    FieldSet::make('Abstract of Canvass Items')
                        ->columns(1)
                        ->label('Abstract of Canvass Items')
                        ->schema([
                            Repeater::make('abstract_of_canvass_items')
                                //->addStatePath('abstract_of_canvass_items')
                               ->relationship('abstract_of_canvass_items')
                               ->columns(4)
                               ->label('Items List')
                               ->addActionLabel('Add Item')
                               ->reorderableWithButtons()
                               ->itemLabel(fn (array $state): ?string => $state['item'] ?? null)
                               ->collapsible()
                                ->schema([
                                    TextInput::make('item')
                                        ->label('Item No.')
                                        ->columnSpan(1)
                                        ->required()
                                        ->rules(['gt:0'])
                                        ->type('number')
                                        ->hint('Current Items: ' . Abstract_of_Canvass_Items::max('item') + 1)
                                        ->placeholder('Select Item'),
    
                                    TextInput::make('particulars')
                                        ->required()
                                        ->placeholder('Enter Particulars')
                                        ->columnSpan(2)
                                        ->label('Particulars'),
    
                                    TextInput::make('quantity')
                                        ->required()
                                        ->columnSpan(1)
                                        ->rules(['gt:0'])
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
    
                                    TextInput::make('unit_price_each_supplier')
                                        ->type('number') // Use text type for decimal numbers
                                        ->step('0.01') // Specify the precision of the decimal
                                        ->required()
                                        ->rules(['gt:0.00'])
                                        ->label('Unit Price Each Supplier') // Use text type for decimal numbers    
                                        ->placeholder('Enter Unit Price Each Supplier')
                                        ->extraAttributes([
                                            'min' => 0,
                                            'max' => 9999999999999999.99,
                                            'pattern' => '\d+(\.\d{2})?',
                                        ]),
    
                                    TextInput::make('amount_each_supplier')
                                        ->label('Amount Each Supplier') 
                                        ->type('number') // Use text type for decimal numbers
                                        ->required()
                                        ->rules(['gt:0.00'])
                                        ->step('0.01') // Specify the precision of the decimal
                                        ->placeholder('Enter Amount Each Supplier')
                                        ->extraAttributes([
                                            'min' => 0,
                                            'max' => 999999999999999, // Add comma here
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
                TextColumn::make('project_id')
                    ->label('Project ID')
                    ->sortable()
                    ->toggleable()
                    ->columnSpan(1)
                    ->searchable(),
                TextColumn::make('project.project_title')
                    ->label('Project Title')
                    ->sortable()
                    ->columnSpan(1)
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('approved_budget_contract')
                    ->label('Approved Budget Contract')
                    ->sortable()
                    ->columnSpan(1)
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('supplier_company_name')
                    ->label('Supplier Company Name')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('supplier_address')
                    ->label('Supplier Address')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('supplier_contact_no')
                    ->label('Supplier Contact No.')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Abstract_of_Canvass_Form $record) => route('download.abstract.pdf', $record))
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
            'index' => Pages\ListAbstractOfCanvasses::route('/'),
            'create' => Pages\CreateAbstractOfCanvass::route('/create'),
            'edit' => Pages\EditAbstractOfCanvass::route('/{record}/edit'),
        ];
    }    
}
