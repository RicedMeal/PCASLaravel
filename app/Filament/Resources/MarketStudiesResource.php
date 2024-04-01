<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketStudiesResource\Pages;
use App\Filament\Resources\MarketStudiesResource\RelationManagers;
use App\Models\MarketStudies;
use App\Models\Market_Study_Links;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Project;
use Dompdf\FrameDecorator\Text;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn as ColumnsTextColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;

class MarketStudiesResource extends Resource
{
    protected static ?string $model = MarketStudies::class;
    protected static ?string $modelItems = Market_Study_Links::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    protected static ?int $navigationSort = 5;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Fieldset::make('Project Information')
                ->columns(2)
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
                    TextInput::make('market_study_title')
                    ->label('Market Study Title')
                    ->columnSpan(1)
                    ->required()
                    ->placeholder('Enter Market Study Title')
                ]),
                Fieldset::make()
                    ->columns(1)
                    ->schema([
                        Repeater::make('market_study_links')
                        ->columns(4)
                        ->relationship('market_study_links')
                        ->addActionLabel('Add Market Study Link')
                        ->reorderableWithButtons()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['market_study_url'] ?? null)
                        ->schema([
                            TextInput::make('market_study_url')
                            ->label('Market Study URL')
                            ->required()
                            ->columnSpan(2)
                            ->placeholder('Enter Market Study URL'),
                            TextInput::make('market_study_url_description')
                            ->label('Market Study URL Description')
                            ->columnSpan(2)
                            ->placeholder('Enter Market Study URL Description'),
                        ])
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('market_study_title')
                    ->label('Market Study Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project.project_title')
                    ->label('Project Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('market_study_links.market_study_url')
                    ->label('Market Study Links')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
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
            'index' => Pages\ListMarketStudies::route('/'),
            'create' => Pages\CreateMarketStudies::route('/create'),
            'edit' => Pages\EditMarketStudies::route('/{record}/edit'),
        ];
    }
}