<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class DownloadPDFController extends Controller
{
    public function download(Project $record)
    {
        
        // Retrieve project data
        $projectId = $record->id;
        $projectTitle = $record->project_title;
        $department = $record->department;
        $projectDescription = $record->project_description;
        $personInCharge = $record->person_in_charge;
        $projectDate = $record->project_date;
        $projectStatus = $record->project_status;

        // Create HTML content for PDF
        $html = "<h1>Project Details</h1>";
        $html .= "<p>Project ID: $projectId</p>";
        $html .= "<p>Project Title: $projectTitle</p>";
        $html .= "<p>Department: $department</p>";
        $html .= "<p>Project Description: $projectDescription</p>";
        $html .= "<p>Person in Charge: $personInCharge</p>";
        $html .= "<p>Project Date: $projectDate</p>";
        $html .= "<p>Project Status: $projectStatus</p>";

        // Create Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream("project_details.pdf");
    }
}
