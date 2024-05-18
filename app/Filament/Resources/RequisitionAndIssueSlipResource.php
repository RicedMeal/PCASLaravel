<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequisitionAndIssueSlipResource\Pages;
use App\Filament\Resources\RequisitionAndIssueSlipResource\RelationManagers;
use App\Models\Requisition;
use App\Models\Requisition_Items;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;

class RequisitionAndIssueSlipResource extends Resource
{
    protected static ?string $model = Requisition::class;

    protected static ?string $modelItems = Requisition_Items::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    protected static ?string $modelLabel = 'Requisition and Issue Slip';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Requisition and Issue Slip Information')
                        ->columns(2)
                        ->schema([
                            Select::make('project_id')
                                ->label('Project ID')
                                ->columnspan(1)
                                ->required()
                                ->options(
                                    Project::all()->mapWithKeys(function ($project) {
                                        return [$project->id => $project->id . ' - ' . $project->project_title];
                                    })->toArray()
                                ),
                            TextInput::make('division')
                                ->label('Division')
                                ->placeholder('Enter Division')
                                ->columnspan(1),
                            TextInput::make('office')
                                ->required()
                                ->default('PFMO')
                                ->readOnly()
                                ->columnspan(1)
                                ->label('Office'),
                            TextInput::make('responsibility_center_code')
                                ->label('Responsibility Center Code')
                                ->placeholder('Enter Responsibility Center Code')
                                ->columnspan(1),
                            TextInput::make('ris_no')
                                ->label('RIS No.')
                                ->placeholder('Enter RIS No.')
                                ->columnspan(1),
                            TextInput::make('sai_no')
                                ->label('SAI No.')
                                ->placeholder('Enter SAI No.')
                                ->columnspan(1),
                            DatePicker::make('date')
                                ->label('Date')
                                ->required()
                                ->columnspan(1),
                            TextInput::make('purpose')
                                ->label('Purpose')
                                ->required()
                                ->placeholder('Enter Purpose')
                                ->columnspan(2),
                        ]),
                    Wizard\Step::make('Requisition Items List')
                        ->schema([
                            Repeater::make('requisition_items')
                                ->columns(3)
                                ->reorderableWithButtons()
                                ->collapsible()
                                ->addActionLabel('Add Requisition Item')
                                ->itemLabel(fn (array $state): ?string => $state['description'] ?? null)
                                ->label('Requisition Items')
                                ->relationship('requisition_items')
                                ->schema([
                                    TextInput::make('stock_no')
                                        ->label('Stock No.')
                                        ->columnspan(1)
                                        ->required()
                                        ->rules(['gt:0'])
                                        ->type('number')
                                        ->placeholder('Enter Stock No.'),
                                    TextInput::make('quantity')
                                        ->label('Quantity')
                                        ->columnspan(1)
                                        ->required()
                                        ->placeholder('Enter Quantity')
                                        ->type('number')
                                        ->rules(['gt:0']),
                                    Select::make('unit')
                                        ->label('Unit')
                                        ->columnspan(1)
                                        ->required()
                                        ->placeholder('Select Unit')
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
                                    TextInput::make('description')
                                        ->label('Description')
                                        ->columnspan(3)
                                        ->required()
                                        ->rules(['string', 'max:150'])
                                        ->placeholder('Enter Description'),     
                                ]),
                            ]),
                    Wizard\Step::make('Signatories')
                        ->columns(2)
                        ->schema([
                            TextInput::make('requested_by_name')
                                ->label('Requested By Name')
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Requested By Name')
                                ->columnspan(1),
                            TextInput::make('requested_by_designation')
                                ->label('Requested By Designation')
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Requested By Designation')
                                ->columnspan(1),
                            TextInput::make('approved_by_name')
                                ->label('Approved By Name')
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Approved By Name')
                                ->columnspan(1),
                            TextInput::make('approved_by_designation')
                                ->label('Approved By Designation')
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Approved By Designation')
                                ->columnspan(1),
                            TextInput::make('issued_by_name')
                                ->label('Issued By Name')
                                ->default('Renato Orijuela')
                                ->readOnly()
                                ->columnspan(1),
                            TextInput::make('issued_by_designation')
                                ->label('Issued By Designation')
                                ->default('Sore Keeper I, PFMO')
                                ->readOnly()
                                ->columnspan(1),
                            TextInput::make('received_by_name')
                                ->label('Received By Name')
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Received By Name')
                                ->columnspan(1),
                            TextInput::make('received_by_designation')
                                ->label('Received By Designation')
                                ->rules(['string', 'max:100'])
                                ->placeholder('Enter Received By Designation')
                                ->columnspan(1),
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.project_title')
                    ->label('Project Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('office')
                    ->label('Office')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ris_no')
                    ->label('RIS No.')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Created')
                    ->searchable()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->searchable()
                    ->dateTime()
                    ->sortable(),
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
                    Tables\Actions\Action::make('Download')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('primary')
                        ->url(fn(Requisition $record) => route('requisition_and_issue_slip.pdf', $record))
                        ->openUrlInNewTab(),
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
            'index' => Pages\ListRequisitionAndIssueSlips::route('/'),
            'create' => Pages\CreateRequisitionAndIssueSlip::route('/create'),
            'edit' => Pages\EditRequisitionAndIssueSlip::route('/{record}/edit'),
        ];
    }
}
