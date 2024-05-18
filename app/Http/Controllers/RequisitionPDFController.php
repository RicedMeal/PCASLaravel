<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Requisition;
use App\Models\Requisition_Items;

class RequisitionPDFController extends Controller
{
    public function pdf($requisitionId)
    {
        //retrieve requisition data
        $requisition = Requisition::where('id', $requisitionId)->first();

        //retrieve requisition items data
        $requisitionItems = Requisition_Items::where('requisition_id', $requisition->id)->get();

        //define the image path
        $imagePath = public_path('images/plm-logo.png');

        $requisition->load('project');

        //pass data to the view
        $data = compact('requisition', 'requisitionItems', 'imagePath');

        //generate PDF
        $pdf = PDF::loadView('pdf.requisition_and_issue_slip', $data);

        //set headers for download
        return $pdf->stream('requisition.pdf'); //download for automatic download and stream for viewing in browser
    }
}
