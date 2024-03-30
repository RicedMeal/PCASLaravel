<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\TablesServiceProvider;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    protected static ?string $label = 'Create Project';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('project_title')
                    ->required()
                    ->autofocus()
                    ->label('Project Title')
                    ->placeholder('Enter Project Title'),
                Select::make('department')
                    ->required()
                    ->options([
                        'Accounting' => 'Accounting',
                        'Admin' => 'Admin',
                        'ICTO' => 'ICTO',
                        'Procurement' => 'Procurement',
                        'Purchasing' => 'Purchasing',
                        'PFMO' => 'PFMO',
                        'PSO' => 'PSO',
                    ])
                    ->placeholder('Select Department/Office')
                    ->label('Department/Office'),
                TextInput::make('project_description')
                    ->required()
                    ->label('Project Description')
                    ->placeholder('Enter Project Description'),
                TextInput::make('person_in_charge')
                    ->readonly()
                    ->label('Person in Charge')
                    ->default(function () {
                        return auth()->user()->name;
                    }),
                TextInput::make('project_date')
                    ->readonly()
                    ->label('Project Date')
                    ->default(now()->format('Y-m-d'))
                    ->placeholder('Enter Project Date'),
                Select::make('project_status')
                    ->options([
                        'Approved' => 'Approved',
                        'Cancelled' => 'Cancelled',
                        'Completed' => 'Completed',
                        'Draft' => 'Draft',
                        'Pending' => 'Pending',
                        'Ongoing' => 'Ongoing',
                        'Urgent' => 'Urgent',
                    ])
                    ->placeholder('Select Status')
                    ->label('Project Status'),    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label('Project ID'),
                TextColumn::make('project_title')
                    ->searchable()
                    ->sortable()
                    ->label('Project Title'),
                TextColumn::make('department')
                    ->searchable()
                    ->label('Department/Office')
                    ->sortable(),
                TextColumn::make('person_in_charge')
                    ->searchable()
                    ->label('Person in Charge')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->label('Last Updated')
                    ->sortable(),
            TextColumn::make('project_status')
                    ->searchable()
                    ->label('Project Status') 
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Project $record) => route('projects.pdf', $record))
                    ->openUrlInNewTab(),
                    
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
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
