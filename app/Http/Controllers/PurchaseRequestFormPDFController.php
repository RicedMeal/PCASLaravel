<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Request_Form;
use App\Models\MarketStudies;
use App\Models\MarketStudiesItems;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PurchaseRequestFormPDFController extends Controller
{
    public function pdf($prId)
    {
        // Retrieve purchase request form data
        $purchaseRequestForm = Purchase_Request_Form::find($prId);

        // If no purchase request form is found, handle it gracefully
        if (!$purchaseRequestForm) {
            return response()->json(['message' => 'Purchase Request Form not found'], 404);
        }

        // Retrieve purchase request items data
        $marketStudiesItems = MarketStudiesItems::where('market_studies_id', $purchaseRequestForm->market_studies_id)->get();

        // Retrieve market studies data
        $marketStudies = MarketStudies::find($purchaseRequestForm->market_studies_id);

        // If market studies are found, load the relationship
        if ($marketStudies) {
            $marketStudies->load('purchase_request_form');
        }

        // Define the image path
        $imagePath = public_path('images/plm-logo.png');

        // Pass data to the view, so it can be displayed in the PDF
        $data = compact('purchaseRequestForm', 'imagePath', 'marketStudiesItems', 'marketStudies');

        // Generate PDF
        $pdf = PDF::loadView('pdf.purchase_request_pdf', $data);

        // Set headers for download
        return $pdf->stream('purchase_request.pdf'); // download for automatic download and stream for viewing in browser
    }
}

