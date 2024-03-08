<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProjectResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ProjectStatus extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(ProjectResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('id', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label('Project ID'),
                Tables\Columns\TextColumn::make('project_title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('person_in_charge')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_date')
                    ->searchable()
                    ->sortable(),
            ]);
    }
}
