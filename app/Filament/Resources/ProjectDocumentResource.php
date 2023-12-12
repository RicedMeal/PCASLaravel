<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectDocumentResource\Pages;
use App\Filament\Resources\ProjectDocumentResource\RelationManagers;
use App\Models\ProjectDocument;
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
use App\Models\Project;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ButtonColumn;


class ProjectDocumentResource extends Resource
{
    protected static ?string $model = ProjectDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('project_id')
                    ->label('Project ID')
                    ->columnSpan(3)
                    ->required()
                    ->options(
                        Project::all()->mapWithKeys(function ($project) {
                            return [$project->id => $project->id . ' - ' . $project->project_title];
                        })->toArray()
                    ),
                Section::make()->schema([
                    FileUpload::make('purchase_request')
                        ->multiple(false)
                        ->placeholder('Upload a file')
                        ->preserveFilenames()
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
                    FileUpload::make('purchase_order')
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
                    FileUpload::make('complete_staff_work')
                        ->multiple(false)
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('accomplishment_report')
                        ->multiple(false)
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('supplementary_docuement')
                        ->multiple(false)
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_id')
                    ->searchable()
                    ->label('Project ID'),
                TextColumn::make('project.project_title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('id')
                    ->searchable()
                    ->label('Project Document ID'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Download')
                    ->icon('heroicon-o-rectangle-stack')
                    ->url(fn(ProjectDocument $record) => route('projects.pdf', $record))
                    ->openUrlInNewTab(),
                

            ])
            ->bulkActions([
                //Tables\Actions\BulkActionGroup::make([
                //Tables\Actions\DeleteBulkAction::make(),

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
            'index' => Pages\ListProjectDocuments::route('/'),
            'create' => Pages\CreateProjectDocument::route('/create'),
            'edit' => Pages\EditProjectDocument::route('/{record}/edit'),
        ];
    }
}
