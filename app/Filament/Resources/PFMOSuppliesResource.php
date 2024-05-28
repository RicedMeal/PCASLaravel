<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PfmoSuppliesResource\Pages;
use App\Filament\Resources\PfmoSuppliesResource\RelationManagers;
use App\Models\PfmoSupplies;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\PFMO_Supplies;

class PfmoSuppliesResource extends Resource
{

    protected static ?string $model = PFMO_Supplies::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    protected static ?string $navigationGroup = 'SUPPLY INVENTORY';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
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
            'index' => Pages\ListPfmoSupplies::route('/'),
            'create' => Pages\CreatePfmoSupplies::route('/create'),
            'edit' => Pages\EditPfmoSupplies::route('/{record}/edit'),
        ];
    }
}
