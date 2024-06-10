<?php

namespace App\Http\Controllers;

use App\Models\MarketStudies;
use App\Models\MarketStudiesItems;
use App\Models\Purchase_Request_Form;
use App\Models\Purchase_Request_Items;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PurchaseRequestFormPDFController extends Controller
{
    public function pdf($prId)
    {
        //retrieve purchase request form data
        $purchaseRequestForm = Purchase_Request_Form::where('id', $prId)->first();

        //retrieve purchase request items data
        $marketStudiesItems = MarketStudiesItems::where('id', $purchaseRequestForm->id)->get();

        $marketStudies = MarketStudies::where('id', $purchaseRequestForm->id)->first();

        //define the image path
        $imagePath = public_path('images/plm-logo.png');

        $marketStudies->load('purchase_request_form');

        $marketStudiesItems->load('purchase_request_form');

        //pass data to the view, so it can be displayed in the PDF
        $data = compact('purchaseRequestForm', 'imagePath', 'marketStudiesItems', 'marketStudies');

        //generate PDF
        $pdf = PDF::loadView('pdf.purchase_request_pdf', $data);

        //set headers for download
        return $pdf->stream('purchase_request.pdf'); //download for automatic download and stream for viewing in browser
    }
}
