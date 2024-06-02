<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketStudiesResource\Pages;
use App\Filament\Resources\MarketStudiesResource\RelationManagers;
use App\Models\MarketStudies;
use App\Models\MarketStudiesItems;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarketStudiesResource extends Resource
{
    protected static ?string $model = MarketStudies::class;

    protected static ?string $modelItems = MarketStudiesItems::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Items Information')
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        Select::make('project_id')
                            ->label('Project ID')
                            //->required()
                            ->options(
                                Project::all()->mapWithKeys(function ($project) {
                                    return [$project->id => $project->id . ' - ' . $project->project_title];
                                })->toArray()
                            ),
                        TextInput::make('average_unit_price')
                            ->label('Average Unit Price'),
                            //->required(),
                        TextInput::make('subtotal_average')
                            ->label('Subtotal Average'),
                            //->required(),
                        TextInput::make('total_average')
                            ->label('Total Average')
                        ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_id')
                    ->label('Project ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('average_unit_price')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('subtotal_average')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('total_average')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
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
            RelationManagers\MarketStudiesItemsRelationManager::class,
            RelationManagers\MarketStudiesSupplierRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarketStudies::route('/'),
            'create' => Pages\CreateMarketStudies::route('/create'),
            'edit' => Pages\EditMarketStudies::route('/{record}/edit'),
        ];
    }
}
