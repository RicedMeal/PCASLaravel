<?php

namespace App\Http\Controllers;

use App\Filament\Resources\ProjectDocumentResource as ResourcesProjectDocumentResource;
use App\Models\ProjectDocument;
use Illuminate\Http\Request; // Import Request class
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ProjectDocumentResource;

class ProjectDocumentController extends Controller
{
    // public function downloadSinglePdf(Request $request, $id, $columnNames)
    // {
    //     // Find the ProjectDocument by ID
    //     $projectDocument = ProjectDocument::findOrFail($id);

    //     // Ensure that the column name is one of the 13 columns
    //     // This is a security measure to prevent potential SQL injection
    //     $columnNames = ['purchase_request', 'price_quotation', 'abstract_of_canvass', 'material_and_cost_estimates', 'budget_utilization_request', 'project_initiation_proposal', 'annual_procurement_plan', 'purchase_order', 'market_study', 'certificate_of_fund_allotment', 'complete_staff_work', 'accomplishment_report', 'supplementary_document'];
    //     if (!in_array($columnName, $columnNames)) {
    //         abort(404, 'Column not allowed.');
    //     }

    //     // Get the file path from the selected column name
    //     $pdfFilePath = $projectDocument->$columnName;

    //     // Check if the PDF file path exists
    //     if (!$pdfFilePath || !Storage::exists($pdfFilePath)) {
    //         abort(404, 'File not found.');
    //     }

    //     // Set the appropriate headers for downloading the PDF file
    //     $headers = [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'attachment; filename="' . basename($pdfFilePath) . '"',
    //     ];

    //     // Return the PDF binary data as a downloadable response
    //     return response()->file(storage_path('app/' . $pdfFilePath), $headers);
    // }
    
    public function downloadPdf(ProjectDocument $id, $columnName)
    {
        // Get the file content using the getFileContent method
        $fileContent = $id->getFileContent($columnName);
    
        // Check if file content exists
        if (!$fileContent) {
            abort(404, 'File not found.');
        }
    
        // Set the appropriate headers for downloading the PDF file
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . basename($id->$columnName) . '"',
        ];
    
        // Return the PDF binary data as a downloadable response
        return response($fileContent, 200, $headers);
    }

    
    public function downloadAllPdfs($id)
    {
        // Find the project document by ID
        $projectDocument = ProjectDocument::findOrFail($id);

        // Retrieve all PDF files associated with the project document
        $pdfs = $projectDocument->getAllPdfs();

        // Prepare the zip file name
        $zipFileName = 'project_' . $projectDocument->id . '_pdfs.zip';

        // Create a new zip archive
        $zip = new \ZipArchive;
        $zip->open(storage_path('app/' . $zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Add each PDF file to the zip archive
        foreach ($pdfs as $columnName => $pdfContent) {
            if ($pdfContent !== null) {
                $zip->addFromString($projectDocument->$columnName . '', $pdfContent);
            }
        }

        // Close the zip archive
        $zip->close();

        // Return the zip file for downloading
        return response()->download(storage_path('app/' . $zipFileName))->deleteFileAfterSend(true);
    }
}
