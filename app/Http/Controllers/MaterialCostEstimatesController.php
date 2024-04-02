<?php

namespace App\Http\Controllers;

use App\Models\MaterialCostEstimates;
use App\Models\MaterialCostEstimatesItems;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MaterialCostEstimatesController extends Controller
{
    public function pdf($mceId)
    {
        //retrieve material cost estimates form data
        $materialCostEstimates = MaterialCostEstimates::where('id', $mceId)->first();

        //retrieve material cost estimates items data
        $materialCostEstimatesItems = MaterialCostEstimatesItems::where('material_cost_estimates_id', $materialCostEstimates->id)->get();

        //define the image path
        $imagePath = public_path('images/plm-logo.png');

        $materialCostEstimates->load('project');

        //pass data to the view
        $data = compact('materialCostEstimates', 'materialCostEstimatesItems', 'imagePath');

        //generate PDF
        $pdf = PDF::loadView('pdf.material_cost_estimates_pdf', $data);

        //set headers for download
        return $pdf->stream('material_cost_estimates.pdf'); //download for automatic download and stream for viewing in browser
    }
}
