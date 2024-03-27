<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectDocumentsController extends Controller
{
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

