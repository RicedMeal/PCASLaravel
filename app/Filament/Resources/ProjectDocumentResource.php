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
use Illuminate\Support\HtmlString;


class ProjectDocumentResource extends Resource
{
    protected static ?string $model = ProjectDocument::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-plus';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'PROJECT MANAGEMENT';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function downloadable()
    {
        return true;
    }

    public static function openable()
    {
        return true;
    }


    
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
                        ->storeFileNamesIn('purchase_request_file_name')
                        ->label('Purchase Request')
                        ->downloadable()
                        ->openable()
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('price_quotation')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('price_quotation_file_name')
                        ->label('Price Quotation')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('abstract_of_canvass')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('abstract_of_canvass_file_name')
                        ->label('Abstract of Canvass')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('material_and_cost_estimates')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('material_and_cost_estimates_file_name')
                        ->label('Material and Cost Estimates')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('budget_utilization_request')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('budget_utilization_request_file_name')
                        ->label('Budget Utilization Request')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('project_initiation_proposal')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('project_initiation_proposal_file_name')
                        ->placeholder('Upload a file')
                        ->label('Project Initiation Proposal')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('annual_procurement_plan')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('annual_procurement_plan_file_name')
                        ->placeholder('Upload a file')
                        ->label('Annual Procurement Plan')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('purchase_order')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('purchase_order_file_name')
                        ->placeholder('Upload a file')
                        ->label('Purchase Order')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('market_study')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('market_study_file_name')
                        ->label('Market Study')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('certificate_of_fund_allotment')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('certificate_of_fund_allotment_file_name')
                        ->label('Certificate of Fund Allotment')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('complete_staff_work')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('complete_staff_work_file_name')
                        ->label('Complete Staff Work')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('accomplishment_report')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->storeFileNamesIn('accomplishment_report_file_name')
                        ->label('Accomplishment Report')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('supplementary_document')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->storeFileNamesIn('supplementary_document_file_name')
                        ->downloadable()
                        ->label('Supplementary Document')
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
                    ->sortable()
                    ->toggleable()
                    ->label('Project ID'),
                TextColumn::make('project.project_title')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('purchase_request')
                    ->label('Purchase Request')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price_quotation')
                    ->label('Price Quotation')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                ->slideOver(),                
            
                Tables\Actions\Action::make('Download All')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->label('Download All')
                    ->url(fn($record) => route('project-documents.downloadAllPdfs', ['id' => $record->getKey()])),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make('delete')

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
            'index' => Pages\ListProjectDocuments::route('/'),
            'create' => Pages\CreateProjectDocument::route('/create'),
            'edit' => Pages\EditProjectDocument::route('/{record}/edit'),
        ];
    }
}
