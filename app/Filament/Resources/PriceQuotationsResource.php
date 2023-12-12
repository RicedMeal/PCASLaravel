<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceQuotationsResource\Pages;
use App\Filament\Resources\PriceQuotationsResource\RelationManagers;
use App\Models\PriceQuotation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;

class PriceQuotationsResource extends Resource
{
    protected static ?string $model = PriceQuotation::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-clip';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'VENDOR MANAGEMENT';

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
                Tables\Actions\Action::make('Download')
                    ->icon('heroicon-o-rectangle-stack')
                    ->url(fn(PriceQuotation $record) => route('projects.pdf', $record))
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
            'index' => Pages\ListPriceQuotations::route('/'),
            'create' => Pages\CreatePriceQuotations::route('/create'),
            'edit' => Pages\EditPriceQuotations::route('/{record}/edit'),
        ];
    }
}
