<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocument;
use ZipArchive;
use Illuminate\Support\Facades\Log;

class ProjectDocumentController extends Controller
{

    public function downloadAllPdfs($id)
{
    try {
        // Find the project document by ID
        $projectDocument = ProjectDocument::findOrFail($id);

        // Retrieve all PDF files associated with the project document
        $pdfs = $projectDocument->getAllPdfs();

        // Prepare the zip file name
        $zipFileName = 'project_' . $projectDocument->id . '_all_pdfs.zip';
        $zipFilePath = public_path('/uploads/' . $zipFileName);


        // Create a new zip archive
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($pdfs as $pdf) {
                // Check if $pdf is a valid file name
                if (is_string($pdf) && file_exists(public_path('/uploads/' . $pdf))) {
                    // Add the file to the root of the zip archive
                    $zip->addFile(public_path('/uploads/' . $pdf), basename($pdf));
                }
            }

            // Close the zip archive
            $zip->close();

            // Check if the zip file was created successfully
            if (file_exists($zipFilePath)) {
                // Return the zip file for downloading
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            } else {
                Log::error("Failed to create zip archive: $zipFilePath");
                return response()->json(['error' => 'Failed to create zip archive'], 500);
            }
        } else {
            // Handle zip archive creation failure
            Log::error("Failed to open zip archive: $zipFilePath");
            return response()->json(['error' => 'Failed to create zip archive'], 500);
        }
    } catch (\Exception $e) {
        // Handle any exceptions
        Log::error("Error downloading PDFs: " . $e->getMessage());
        return response()->json(['error' => 'Failed to download PDFs'], 500);
    }
}


}

