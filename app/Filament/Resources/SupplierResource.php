<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers;
use App\Models\Project;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->label('Project ID')
                    ->options(Project::all()->pluck('id', 'id'))
                    ->searchable(),
                TextInput::make('supplier_name')
                    ->required()
                    ->placeholder('Enter Supplier Name'),
                TextInput::make('address')
                    ->required()
                    ->placeholder('Enter Address'),
                TextInput::make('tel_no')
                    ->required()
                    ->placeholder('Enter Telephone Number'),
                TextInput::make('fax_no')
                    ->placeholder('Enter Fax Number'),
                TextInput::make('website')
                    ->placeholder('Enter Website'),
                TextInput::make('contact_person')
                    ->required()
                    ->placeholder('Enter Contact Person'),
                TextInput::make('email')
                    ->required()
                    ->placeholder('Enter Email'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->label('Supplier ID'),
                TextColumn::make('project_id')
                    ->searchable()
                    ->sortable()
                    ->label('Project ID'),
                TextColumn::make('supplier_name')
                    ->searchable()
                    ->sortable()
                    ->label('Supplier Name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }    
}
