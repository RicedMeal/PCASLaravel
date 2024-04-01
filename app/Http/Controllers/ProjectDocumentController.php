<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocument;


class ProjectDocumentController extends Controller
{

    public function downloadAllPdfs($id)
    {
        ob_end_clean();
        // Find the project document by ID
        $projectDocument = ProjectDocument::findOrFail($id);

        // Retrieve all PDF files associated with the project document
        $pdfs = $projectDocument->getAllPdfs();

        // Prepare the zip file name
        $zipFileName = 'project_' . $projectDocument->id . '_pdfs.zip';

        // Create a new zip archive
        $zip = new \ZipArchive;
        $zip->open(public_path('storage/' . $zipFileName), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        // Add each PDF file to the zip archive
        foreach ($pdfs as $columnName => $pdfContent) {
            if ($pdfContent !== null) {
                $zip->addFromString($projectDocument->$columnName . '', $pdfContent);
            }
        }

        // Close the zip archive
        $zip->close();

        // Return the zip file for downloading
        return response()->download(public_path('storage/' . $zipFileName))->deleteFileAfterSend(true);
    }
}
