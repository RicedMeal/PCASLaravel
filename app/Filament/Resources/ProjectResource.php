<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    protected static ?string $label = 'Projects';

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
                    ->rules(['string', 'max:100'])
                    ->placeholder('Enter Project Title'),
                TextInput::make('department')
                    ->required()
                    ->default('PFMO')
                    ->readOnly()
                    ->placeholder('Select Department/Office')
                    ->label('Department/Office'),
                TextInput::make('project_description')
                    ->required()
                    ->columnSpan(2)
                    ->label('Project Description')
                    ->rules(['string', 'max:150'])
                    ->placeholder('Enter Project Description'),
                TextInput::make('person_in_charge')
                    ->readonly()
                    ->label('Person in Charge')
                    ->default(function () {
                        return auth()->user()->name;
                    }),
                Select::make('quarter')
                    ->placeholder('Select Quarter to Implement Project')
                    ->required()
                    ->label('Quarter')
                    ->options([
                        'Q1' => 'Q1',
                        'Q2' => 'Q2',
                        'Q3' => 'Q3',
                        'Q4' => 'Q4',
                        'Q1-Q2' => 'Q1-Q2',
                        'Q1-Q3' => 'Q1-Q3',
                        'Q1-Q4' => 'Q1-Q4',
                        'Q2-Q3' => 'Q2-Q3',
                        'Q2-Q4' => 'Q2-Q4',
                        'Q3-Q4' => 'Q3-Q4',
                    ]),
                DatePicker::make('project_start')
                    ->label('Project Start')
                    ->required()
                    ->displayFormat('Y/m/d'),
                DatePicker::make('project_end')
                    ->label('Project End')
                    ->required()
                    ->displayFormat('Y/m/d'),
                Select::make('project_status')
                    ->required()
                    ->options([
                        'Ongoing' => 'Ongoing',
                        'Urgent' => 'Urgent',
                        'Completed' => 'Completed',
                        'Pending' => 'Pending',
                    ])
                    ->placeholder('Select Status')
                    ->label('Project Status'),
                Select::make('project_type')
                    ->required()
                    ->options([
                        'Major Project' => 'Major Project',
                        'Minor Project' => 'Minor Project',
                    ])
                    ->placeholder('Select Project Type')
                    ->label('Project Type'),
                TextInput::make('alloted_project_cost')
                    ->label('Alloted Project Cost')
                    ->placeholder('From Annual Procurement Plan')
                    ->prefix('₱')
                    ->rules('numeric', 'gt:0.00'),
                /*
                TextInput::make('alloted_project_cost')
                    ->label('Actual Project Cost')
                    ->placeholder('Enter Actual Project Cost')
                    ->prefix('₱')
                    //->requiredUnless('project_type', 'Pending')
                    ->rules([
                        'numeric',
                        'gt:0.00',
                        fn ($get) => function (string $attribute, $value, $fail) use ($get) {
                            if ($get('project_type') === 'Major Project' && (!isset($value) || $value <= 999999.00)) {
                                $fail("The Project Cost must be 1,000,000.00 and above for Major Project.");
                            } elseif ($get('project_type') === 'Minor Project' && (!isset($value) || $value >= 1000000.00)) {
                                $fail("The Project Cost must be less than 1,000,000.00 for Minor Project.");
                            }
                        },
                    ]),

                TextInput::make('placeholderField') #placeholders for project costings
                    ->label('Alloted Budget Cost') #FORM BUILDER NALANG MATITIRA
                    ->placeholder('This will come from Annual Procurement Plan and will be manually inputted by the user') #Need may user input
                    ->disabled(true),
                TextInput::make('placeholderField') #placeholders for project costings
                    ->label('Estimated Budget Cost') #Pwedeng tanggalin from form builder to table builder
                    ->placeholder('This will come from End-User (PFMO) and will be is reflected via Materials and Cost Estimates') #Mag rereflect sa Materials and Cost Estimates
                    ->disabled(true), 
                TextInput::make('placeholderField') #placeholders for project costings
                    ->label('Actual Cost') #Pwedeng tanggalin from form builder to table builder
                    ->placeholder('This will come from Abstract of Canvass (From Procurement Office)')
                    ->disabled(true),
                TextInput::make('placeholderField') #placeholders for project costings
                    ->label('Cost Variance')
                    ->placeholder('Alloted Cost - Actual Cost') #Pwedeng tanggalin from form builder to table builder
                    ->disabled(true),*/

            ]);
    }

    public static function table(Table $table): Table
    //This will come from Abstract of Canvass (From Procurement Office) Actual Cost
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label('Project ID'),
                TextColumn::make('alloted_project_cost')
                    ->searchable()
                    ->prefix('₱')
                    ->placeholder('From Annual Procurement Plan')
                    ->label('Alloted Project Cost')
                    ->color('success')
                    ->sortable(),
                TextColumn::make('material_cost_estimates.total') //This will come from End-User (PFMO) and will be is reflected via Materials and Cost Estimates | Mag rereflect sa Materials and Cost Estimates - Estima
                    ->searchable()
                    ->prefix('₱')
                    ->placeholder('From Materials and Cost Estimates')
                    ->color('gray')
                    ->label('Estimated Budget Cost') 
                    ->sortable(),
                TextColumn::make('actual_cost')
                    ->searchable()
                    ->prefix('₱')
                    ->placeholder('From Abstract of Canvass')
                    ->color('primary')
                    ->label('Actual Cost')  //This will come from Abstract of Canvass (From Procurement Office) Actual Cost
                    ->sortable(),
                TextColumn::make('cost_variance')
                    ->searchable()
                    ->placeholder('Alloted Cost - Actual Cost')
                    ->prefix('₱')
                    ->color('red')
                    ->label('Cost Variance') //Alloted Project Cost (From APP) - Actual Cost (From Abstract of Canvass)
                    ->sortable(),
                TextColumn::make('project_title')
                    ->searchable()
                    ->limit(30)
                    ->sortable()
                    ->label('Project Title'),
                TextColumn::make('project_type')
                    ->searchable()
                    ->label('Project Type')
                    ->sortable(),
                TextColumn::make('project_status')
                    ->searchable()
                    ->label('Project Status')
                    ->sortable(),
                TextColumn::make('department')
                    ->searchable()
                    ->label('Department')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->searchable()
                    ->label('Date Created')
                    ->date()
                    ->sortable(),
                

            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make()
                    ->label('View Project')
                    ->color('primary'),
                Tables\Actions\EditAction::make()
                    ->label('Edit Project')
                    ->color('primary'),
                //Tables\Actions\Action::make('Download')
                //    ->icon('heroicon-o-arrow-down-tray')
                //    ->url(fn(Project $record) => route('projects.pdf', $record))
                //    ->openUrlInNewTab()
                //    ->color('primary')
                //    ->label('Download Project'),
                Tables\Actions\DeleteAction::make(), //For Archiving
                Tables\Actions\RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn(Project $record) => $record->trashed() === false),
                    Tables\Actions\RestoreBulkAction::make()
                        ->visible(fn(Project $record) => $record->trashed() === false),
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
    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
}
}
