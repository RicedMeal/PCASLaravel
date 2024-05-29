<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PFMOSuppliesResource\Pages;
use App\Filament\Resources\PFMOSuppliesResource\RelationManagers;
use App\Models\PFMO_Supplies;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PFMOSuppliesResource extends Resource
{
    protected static ?string $model = PFMO_Supplies::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('entry_date')
                    ->required()
                    ->label('Entry Date')
                    ->helperText('Choose the entry date. The Custom Code will be generated automatically.'),
                Forms\Components\TextInput::make('custom_code')
                    ->disabled(true)
                    ->label('Custom Code')
                    ->helperText('This field is automatically generated and not editable.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('custom_code')
                ->label('Custom ID')
                ->sortable(), // If you need the column to be sortable
                Tables\Columns\TextColumn::make('entry_date')
                    ->label('Entry Date')
                    ->date(), // Format this as a date, or use ->dateTime() as needed
                //
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
            'index' => Pages\ListPFMOSupplies::route('/'),
            'create' => Pages\CreatePFMOSupplies::route('/create'),
            'edit' => Pages\EditPFMOSupplies::route('/{record}/edit'),
        ];
    }
}
