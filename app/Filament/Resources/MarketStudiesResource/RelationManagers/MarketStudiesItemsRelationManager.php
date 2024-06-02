<?php

namespace App\Filament\Resources\MarketStudiesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\MarketStudies;

class MarketStudiesItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'market_studies_items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('item_no')
                    ->required()
                    ->label('Item No.')
                    ->type('number')
                    ->columnSpan(1)
                    ->unique()
                    ->rules(['gt:0'])
                    //->hint('Current Item No: ' . Purchase_Request_Items::max('item_no') + 1)
                    ->placeholder('Item No. should be unique'),
                Forms\Components\Select::make('unit')
                    ->label('Unit')
                    ->required()
                    ->placeholder('Select Unit')
                    ->columnSpan(1)
                    ->options([
                        'box' => 'box',
                        'length' => 'length',
                        'lot' => 'lot',
                        'pack' => 'pack',
                        'pc.' => 'pc.',
                        'ream' => 'ream',
                        'roll' => 'roll',
                        'set' => 'set',
                        'unit' => 'unit',
                    ]),
                Forms\Components\TextInput::make('particulars')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->type('number')
                    ->maxValue(9999999999999999)
                    ->minValue(1)
                    ->rules(['gt:0'])
                    ->required()
                    ->columnSpan(1)
                    ->placeholder('Enter Quantity')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('particulars')
            ->columns([
                Tables\Columns\TextColumn::make('item_no')
                    ->label('Item No.')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('particulars')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('unit')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
