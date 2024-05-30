<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbstractOfCanvassResource\Pages;
use App\Filament\Resources\AbstractOfCanvassResource\RelationManagers;
use App\Models\Abstract_of_Canvass;
use App\Models\AbstractOfCanvass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbstractOfCanvassResource extends Resource
{
    protected static ?string $model = Abstract_of_Canvass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                TextColumn::make('abstract_of_canvass')
                    ->label('Price Quotation File Name')
                    ->searchable()
                    ->sortable()
                    ->date()
                    ->toggleable(),
                TextColumn::make('abstract_of_canvass_file_name')
                    ->label('File')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Price Quotation File'),
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
            'index' => Pages\ListAbstractOfCanvasses::route('/'),
            'create' => Pages\CreateAbstractOfCanvass::route('/create'),
            'edit' => Pages\EditAbstractOfCanvass::route('/{record}/edit'),
        ];
    }
}
