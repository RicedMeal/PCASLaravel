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
