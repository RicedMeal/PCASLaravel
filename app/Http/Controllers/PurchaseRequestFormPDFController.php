<?php

namespace App\Http\Controllers;

use App\Models\Purchase_Request_Form;
use Dompdf\Dompdf;
use Dompdf\Options;

class PurchaseRequestFormPDFController extends Controller
{
    public function download($id)
    {
//         <img
//     src="https://plm.edu.ph/images/ui/plm-logo--with-header.png"
//     alt="Pamantasan ng Lungsod ng Maynila Logo"
//     class="h-15 w-auto"
// />
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

//     use App\Models\PurchaseRequestForm;
// use App\Models\PurchaseRequestItem;

// // Retrieve data for purchase request form
// $purchaseRequestForm = PurchaseRequestForm::first(); // Example of fetching the first record
// // Or you can use where clause to retrieve specific records
// // $purchaseRequestForm = PurchaseRequestForm::where('id', $id)->first(); // Example of fetching by ID

// // Retrieve data for purchase request items
// $purchaseRequestItems = PurchaseRequestItem::all(); // Example of fetching all records
// // Or you can use where clause to retrieve specific records
// // $purchaseRequestItems = PurchaseRequestItem::where('purchase_request_form_id', $purchaseRequestForm->id)->get(); // Example of fetching items related to a specific purchase request form

// // You can then access the columns of the retrieved data like this:
// $prNo = $purchaseRequestForm->pr_no;
// $date = $purchaseRequestForm->date;
// $section = $purchaseRequestForm->section;
// $saiNo = $purchaseRequestForm->sai_no;
// // And so on for other columns

// // Similarly for purchase request items
// foreach ($purchaseRequestItems as $item) {
//     $itemNo = $item->item_no;
//     $unit = $item->unit;
//     $itemDescription = $item->item_description;
//     $quantity = $item->quantity;
//     // And so on for other columns
// }

}
