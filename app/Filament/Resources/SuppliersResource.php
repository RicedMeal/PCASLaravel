<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuppliersResource\Pages;
use App\Filament\Resources\SuppliersResource\RelationManagers;
use App\Models\Supplier;
use App\Models\Suppliers;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuppliersResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'PROCUREMENT OFFICE';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->readOnly()
                    ->label('name'),
                TextInput::make('category')
                    ->readOnly()
                    ->label('Description'),
                TextInput::make('address')
                    ->readOnly()
                    ->label('Address'),
                TextInput::make('contact_number')
                    ->readOnly()
                    ->label('Contact No.'),
                TextInput::make('email')
                    ->readOnly()
                    ->label('Email'),
                TextInput::make('representative_name')
                    ->readOnly()
                    ->label('Representative Name'),
                TextInput::make('representative_contact_number')
                    ->readOnly()
                    ->label('Representative Contact No.'),
                TextInput::make('representative_email')
                    ->readOnly()
                    ->label('Representative Email'),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('address')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Address'),
                TextColumn::make('contact_number')
                    ->label('Contact Number')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('email')
                    ->label('email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                //
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSuppliers::route('/create'),
            'edit' => Pages\EditSuppliers::route('/{record}/edit'),
        ];
    }
}
