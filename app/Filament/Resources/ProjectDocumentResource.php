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
                        ->label('Purchase Request')
                        ->downloadable(function ($record) {
                            return fn ($record) => route('project-documents.downloadPdf', ['id' => $record->getKey(), 'columnName' => 'purchase_request']);
                        })
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('price_quotation')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Price Quotation')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('abstract_of_canvass')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Abstract of Canvass')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('material_and_cost_estimates')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Material and Cost Estimates')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('budget_utilization_request')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Budget Utilization Request')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('project_initiation_proposal')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->placeholder('Upload a file')
                        ->label('Project Initiation Proposal')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('annual_procurement_plan')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->placeholder('Upload a file')
                        ->label('Annual Procurement Plan')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('purchase_order')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->placeholder('Upload a file')
                        ->label('Purchase Order')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('market_study')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Market Study')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('certificate_of_fund_allotment')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Certificate of Fund Allotment')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('complete_staff_work')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Complete Staff Work')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('accomplishment_report')
                        ->multiple(false)
                        ->preserveFilenames()
                        ->downloadable()
                        ->label('Accomplishment Report')
                        ->placeholder('Upload a file')
                        ->acceptedFileTypes(['application/pdf']),
                    FileUpload::make('supplementary_docuement')
                        ->multiple(false)
                        ->preserveFilenames()
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
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
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
                TextColumn::make('abstract_of_canvass')
                    ->label('Abstract of Canvass')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('material_and_cost_estimates')
                    ->label('Material and Cost Estimates')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('budget_utilization_request')
                    ->label('Budget Utilization Request')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('project_initiation_proposal')
                    ->label('Project Initiation Proposal')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('annual_procurement_plan')
                    ->label('Annual Procurement Plan')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('purchase_order')
                    ->label('Purchase Order')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('market_study')
                    ->label('Market Study')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('certificate_of_fund_allotment')
                    ->label('Certificate of Fund Allotment')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('complete_staff_work')
                    ->label('Complete Staff Work')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('accomplishment_report')
                    ->label('Accomplishment Report')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('supplementary_document')
                    ->label('Supplementary Document')
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
                // Tables\Actions\Action::make('Download Single')
                // ->icon('heroicon-o-arrow-down-tray')
                // ->label('Download Single')
                // ->url(fn($record) => route('project-documents.downloadSinglePdf', ['id' => $record->getKey(), 'columnName' => 'purchase_request']))
                // ->modalContent(function ($record) {
                //     $columnNames = [
                //         'purchase_request' => 'Purchase Request',
                //         'price_quotation' => 'Price Quotation',
                //         'abstract_of_canvass' => 'Abstract of Canvass',
                //         'material_and_cost_estimates' => 'Material and Cost Estimates',
                //         'budget_utilization_request' => 'Budget Utilization Request',
                //         'project_initiation_proposal' => 'Project Initiation Proposal',
                //         'annual_procurement_plan' => 'Annual Procurement Plan',
                //         'purchase_order' => 'Purchase Order',
                //         'market_study' => 'Market Study',
                //         'certificate_of_fund_allotment' => 'Certificate of Fund Allotment',
                //         'complete_staff_work' => 'Complete Staff Work',
                //         'accomplishment_report' => 'Accomplishment Report',
                //         'supplementary_document' => 'Supplementary Document',
                //     ];
                    
                //     $modalContent = '<div class="modal-content bg-white rounded-lg shadow-xl p-6">';
                //     $modalContent .= '<h2 class="text-lg font-semibold mb-4">Select File(s) to Download:</h2>';
                
                //     foreach ($columnNames as $columnName => $label) {
                //         if ($record->$columnName) {
                //             $url = route('project-documents.downloadSinglePdf', ['id' => $record->getKey(), 'columnName' => $columnName]);
                //             $modalContent .= '<a href="'.$url.'" target="_blank" class="button">Download '.$label.'</a>';
                //         }
                //     }
                
                //     $modalContent .= '</div>'; // Close modal-content div
                
                //     return new \Illuminate\Support\HtmlString($modalContent);
                // }),
                
            
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
