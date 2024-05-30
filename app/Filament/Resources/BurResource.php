<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BurResource\Pages;
use App\Filament\Resources\BurResource\RelationManagers;
use App\Models\Bur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BurResource extends Resource
{
    protected static ?string $model = Bur::class;

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
                TextColumn::make('bur_no')
                    ->label('BUR No.')
                    ->searchable()
                    ->sortable()
                    ->date()
                    ->toggleable(),
                TextColumn::make('certificate_of_funds_availability')
                    ->label('CFA File Name')
                    ->searchable()
                    ->sortable()
                    ->date()
                    ->toggleable(),
                /*TextColumn::make('PriceQuotation')
                    ->label('File')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->label('Project ID'),*/

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
            'index' => Pages\ListBurs::route('/'),
            'create' => Pages\CreateBur::route('/create'),
            'edit' => Pages\EditBur::route('/{record}/edit'),
        ];
    }
}
