<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('project_title')
                    ->required()
                    ->autofocus()
                    ->placeholder('Enter Project Title'),
                Select::make('department_office')
                    ->required()
                    ->options([
                        'PFMO' => 'PFMO',
                        'PSO' => 'PSO',
                        // Add more options as needed
                    ])
                    ->placeholder('Select Department/Office')
                    ->label('Department/Office'),
                TextInput::make('project_description')
                    ->required()
                    ->placeholder('Enter Project Description'),
                TextInput::make('person_in_charge')
                    ->readonly()
                    ->default(function () {
                        return auth()->user()->name;
                    }),
                TextInput::make('project_date')
                    ->readonly()
                    ->default(now()->format('Y-m-d'))
                    ->placeholder('Enter Project Date'),
                FileUpload::make('purchase_request')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('price_quotation')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('abstract_of_canvass')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('material_and_cost_estimates')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('budget_utilization_request')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('project_initiation_proposal')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('annual_procurement_plan')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('purchase_request_with_number')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('market_study')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('certificate_of_fund_allotment')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('csw')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                FileUpload::make('accomplishment_report')
                    ->multiple(false)
                    ->placeholder('Upload a file')
                    ->acceptedFileTypes(['application/pdf']),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->label('Project ID'),
                TextColumn::make('project_title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('department_office')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('person_in_charge')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_date')
                    ->searchable()
                    ->sortable(),
                
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }    
}
