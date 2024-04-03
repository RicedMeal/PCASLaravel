<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocument;
use ZipArchive;
use Illuminate\Support\Facades\Log;


class ProjectDocumentController extends Controller
{

    public function downloadAllPdfs($id)
    {
    // Find the project document by ID
    $projectDocument = ProjectDocument::findOrFail($id);

    // Retrieve all PDF files associated with the project document
    $pdfs = $projectDocument->getAllPdfs();

    // Prepare the zip file name
    $zipFileName = 'project_' . $projectDocument->id . '_pdfs.zip';
    $zipFilePath = public_path('storage/' . $zipFileName);

    // Create a new zip archive
    $zip = new \ZipArchive;

    if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
        foreach ($pdfs as $columnName => $pdfContent) {
            if ($pdfContent !== null) {
                $pdfFilePath = public_path('storage/' . $projectDocument->$columnName);
                if (file_exists($pdfFilePath)) {
                    $zip->addFile($pdfFilePath, $projectDocument->$columnName);
                } else {
                    Log::error("File does not exist: $pdfFilePath");
                }
            }
        }
        // Close the zip archive
        $zip->close();

        // Return the zip file for downloading
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    } else {
        // Handle zip archive creation failure
        return response()->json(['error' => 'Failed to create zip archive'], 500);
    }
    }

    public function downloadPdf($id, $columnName)
    {
        $document = ProjectDocument::findOrFail($id);
        
        // Retrieve the file name from the specified column
        $fileName = $document->$columnName;
        
        // Retrieve the file path from storage
        $filePath = storage_path('app/' . $fileName);
        
        // Check if the file exists
        if (file_exists($filePath)) {
            // Return the file as a downloadable response
            return response()->download($filePath, $fileName);
        } else {
            // File not found, return error response
            return response()->json(['error' => 'File not found'], 404);
        }
    }
}

