<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use App\Models\Project;
use Filament\Tables\Columns\TextColumn;


class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Annual Supplies';

    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Inventory Details')
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
                TextInput::make('item_name')
                    ->label('Item Name')
                    ->columnSpan(2)
                    ->required()
                    ->placeholder('Enter Item Name'),
                TextInput::make('item_description')
                    ->label('Item Description')
                    ->columnSpan(2)
                    ->required()
                    ->placeholder('Enter Item Description'),
                TextInput::make('quantity')
                    ->label('Quantity')
                    ->columnSpan(1)
                    ->required()
                    ->placeholder('Enter Quantity'),
                TextInput::make('unit')
                    ->label('Unit')
                    ->columnSpan(1)
                    ->required()
                    ->placeholder('Enter Unit'),
                TextInput::make('date_purchased')
                    ->label('Date Purchased')
                    ->columnSpan(1)
                    ->required()
                    ->placeholder('Enter Date Purchased'),
                TextInput::make('supplier')
                    ->label('Supplier')
                    ->columnSpan(2)
                    ->required()
                    ->placeholder('Enter Supplier'),
                TextInput::make('remarks')
                    ->label('Remarks')
                    ->columnSpan(2)
                    ->required()
                    ->placeholder('Enter Remarks'),
                ])

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label('ID'),
                TextColumn::make('project_id')
                    ->searchable()
                    ->sortable()
                    ->label('Project ID'),
                TextColumn::make('item_name')
                    ->searchable()
                    ->sortable()
                    ->label('Item Name'),
                TextColumn::make('item_description')
                    ->searchable()
                    ->sortable()
                    ->label('Item Description'),
                TextColumn::make('quantity')
                    ->searchable()
                    ->sortable()
                    ->label('Quantity'),
                TextColumn::make('unit')
                    ->searchable()
                    ->sortable()
                    ->label('Unit'),
                TextColumn::make('date_purchased')
                    ->searchable()
                    ->sortable()
                    ->label('Date Purchased'),
                TextColumn::make('supplier')
                    ->searchable()
                    ->sortable()
                    ->label('Supplier'),
                TextColumn::make('remarks')
                    ->searchable()
                    ->sortable()
                    ->label('Remarks'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
