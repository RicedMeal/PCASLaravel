<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Request_Form;
use Dompdf\Dompdf;
use Dompdf\Options;

class PurchaseRequestFormPDFController extends Controller
{
    public function download($id)
    {
        // Retrieve Purchase Request Form data
        $purchaseRequestForm = Purchase_Request_Form::find($id);

        // Check if the record exists
        if (!$purchaseRequestForm) {
            abort(404, 'Purchase Request Form not found');
        }

        // Create HTML content for PDF
        $html = "<h1>Purchase Request Form</h1>";
        $html .= "<p>PR No: $purchaseRequestForm->pr_no</p>";
        $html .= "<p>Date: $purchaseRequestForm->date</p>";
        $html .= "<p>Section: $purchaseRequestForm->section</p>";
        $html .= "<p>Unit: $purchaseRequestForm->unit</p>";
        $html .= "<p>Item Description: $purchaseRequestForm->item_description</p>";
        $html .= "<p>Quantity: $purchaseRequestForm->quantity</p>";
        $html .= "<p>Estimate Unit Cost: $purchaseRequestForm->estimate_unit_cost</p>";
        $html .= "<p>Estimate Cost: $purchaseRequestForm->estimate_cost</p>";
        $html .= "<p>Total: $purchaseRequestForm->total</p>";
        $html .= "<p>Delivery Duration: $purchaseRequestForm->delivery_duration</p>";
        $html .= "<p>Purpose: $purchaseRequestForm->purpose</p>";
        $html .= "<p>Recommended By: $purchaseRequestForm->recommended_by_name</p>";
        $html .= "<p>Recommended By Designation: $purchaseRequestForm->recommended_by_designation</p>";
        $html .= "<p>Approved By: $purchaseRequestForm->approved_by_name</p>";
        $html .= "<p>Approved By Designation: $purchaseRequestForm->approved_by_designation</p>";

        // Create Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream("purchase_request_form.pdf");
    }
}
