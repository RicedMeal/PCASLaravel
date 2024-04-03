<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocument;
use ZipArchive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProjectDocumentController extends Controller
{

    public function downloadAllPdfs($id)
    {
    //find the project document by ID
    $projectDocument = ProjectDocument::findOrFail($id);

    //retrieve all pdf files associated with the project document
    $pdfs = $projectDocument->getAllPdfs();

    //prepare the zip file name
    $zipFileName = 'project_' . $projectDocument->id . '_pdfs.zip';
    $zipFilePath = public_path('storage/' . $zipFileName);

    //create a new zip archive
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
        //close the zip archive
        $zip->close();

        //return the zip file for downloading
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    } else {
        //handle zip archive creation failure
        return response()->json(['error' => 'Failed to create zip archive'], 500);
    }
    }

    public function downloadPdf($id, $columnName)
    {
        $document = ProjectDocument::findOrFail($id);
        
        // Retrieve the file name from the specified column
        $fileName = $document->$columnName;
        
        // Check if the file name is null or empty
        if (!$fileName) {
            return response()->json(['error' => 'File not found'], 404);
        }
        
        // Construct the full file path
        $filePath = storage_path("app/public/$fileName");
        
        // Check if the file exists
        if (!Storage::exists("public/$fileName")) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Return the file as a downloadable response
        return response()->download($filePath, $fileName, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }
    

}

