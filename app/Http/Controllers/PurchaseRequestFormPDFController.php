<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\Purchase_Request_Items;
use App\Models\Purchase_Request_Form;

class PurchaseRequestFormPDFController extends Controller
{
    public function pdf(Request $request, $prNo)
    {
        $purchaseRequest = Purchase_Request_Form::where('pr_no', $prNo)->firstOrFail();
        $purchaseRequestItems = Purchase_Request_Items::all();

        // Load HTML view and pass data
        $html = view('pdf.purchase_request_pdf', [
            'purchaseRequest' => $purchaseRequest,
            'purchaseRequestItems' => $purchaseRequestItems,
            
        ])->render();

        // Instantiate Dompdf
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (generates the PDF)
        $dompdf->render();

        // Output the generated PDF
        return $dompdf->stream('purchase_request.pdf');
    }
}
