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

    public static ?string $recordTitleAttribute = 'project_title';

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
                        'PFMO' => 'PFMO',
                        'PSO' => 'PSO',
                        // Add more options as needed
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
                    ->required()
                    ->label('Project Date')
                    ->default(now()->format('Y-m-d'))
                    ->placeholder('Enter Project Date (YYYY-MM-DD)')
                    ->rules('date_format:Y-m-d'),
                Select::make('project_status')
                    ->required()   
                    ->options([
                        'Ongoing' => 'Ongoing',
                        'Urgent' => 'Urgent',
                        'Completed' => 'Completed',
                        'Cancelled' => 'Cancelled',
                    ])
                    ->placeholder('Select Status')
                    ->label('Project Status'),
                Select::make('project_type')
                    ->required()
                    ->options([
                        'Pending' => 'Pending',
                        'Major Project' => 'Major Project',
                        'Minor Project' => 'Minor Project',
                    ])
                    ->placeholder('Select Project Type')
                    ->label('Project Type'),
                TextInput::make('project_cost')
                    ->label('Project Cost')
                    ->placeholder('Enter Project Cost')
                    ->prefix('₱')
                    ->requiredUnless('project_type', 'Pending')
                    ->rules([
                        'numeric',
                        'gt:0.00',
                        fn ($get) => function (string $attribute, $value, $fail) use ($get) {
                            if ($get('project_type') === 'Major Project' && (!isset($value) || $value <= 1000000.00)) {
                                $fail("The Project Cost must be greater than 1,000,000.00 for Major Project.");
                            } elseif ($get('project_type') === 'Minor Project' && (!isset($value) || $value >= 1000000.00)) {
                                $fail("The Project Cost must be less than 1,000,000.00 for Minor Project.");
                            }
                        },
                    ]),


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
                TextColumn::make('created_at')
                    ->searchable()
                    ->label('Date Created')
                    ->sortable(),
                TextColumn::make('project_title')
                    ->searchable()
                    ->sortable()
                    ->label('Project Title'),
                TextColumn::make('department')
                    ->searchable()
                    ->label('Department/Office')
                    ->sortable(),
                TextColumn::make('project_status')
                    ->searchable()
                    ->label('Project Status') 
                    ->sortable(),
                TextColumn::make('project_type')
                    ->searchable()
                    ->label('Project Type')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->label('Last Updated')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make()
                    ->label('View Project')
                    ->color('primary'),
                Tables\Actions\EditAction::make()
                    ->label('Edit Project')
                    ->color('primary'),
                //Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Project $record) => route('projects.pdf', $record))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->label('Download Project'),
                ]),
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
