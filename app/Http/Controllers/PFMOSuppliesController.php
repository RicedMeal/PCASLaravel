<?php

namespace App\Http\Controllers;
use App\Models\PFMO_Supplies;
use App\Models\PFMO_Supplies_List;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;

class PFMOSuppliesController extends Controller
{
    public function pdf($suppliesId)
    {
        
        $pfmoSupplies = PFMO_Supplies::where('id', $suppliesId)->first();

        
        $pfmoSuppliesLists = PFMO_Supplies_List::where('pfmo_supplies_id', $pfmoSupplies->id)->get();

        //define the image path
        $imagePath = public_path('images/plm-logo.png');

        //pass data to the view
        $data = compact('pfmoSupplies', 'pfmoSuppliesLists', 'imagePath');

        //generate PDF
        $pdf = PDF::loadView('pdf.pfmo_supplies_pdf', $data);

        //set headers for download
        return $pdf->stream('pfmo_supplies.pdf'); //download for automatic download and stream for viewing in browser
    }

}
