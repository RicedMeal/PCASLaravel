<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Purchase_Request_Form;
use App\Models\Purchase_Request_Items;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PurchaseRequestFormPDFController extends Controller
{
    public function pdf($prNo)
    {
        //retrieve purchase request form data
        $purchaseRequestForm = Purchase_Request_Form::where('pr_no', $prNo)->first();

        //retrieve purchase request items data
        $purchaseRequestItems = Purchase_Request_Items::where('purchase_request_form_id', $purchaseRequestForm->id)->get();

        //define the image path
        $imagePath = public_path('images/plm-logo.png');

        $purchaseRequestForm->load('project');

        //pass data to the view
        $data = compact('purchaseRequestForm', 'purchaseRequestItems', 'imagePath');

        //generate PDF
        $pdf = PDF::loadView('pdf.purchase_request_pdf', $data);

        // Set headers for download
        return $pdf->download('purchase_request.pdf'); //download for automatic download and stream for viewing in browser
    }
}
