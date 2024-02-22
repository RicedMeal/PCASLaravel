<?php

namespace App\Http\Controllers;

use App\Models\Abstract_of_Canvass_Form;
use App\Models\AbstractOfCanvassForm;
use Dompdf\Dompdf;
use Dompdf\Options;

class AbstractofCanvassFormPDFController extends Controller
{
    public function download($id)
    {
        // Retrieve Abstract of Canvass Form data
        $abstractOfCanvassForm = Abstract_of_Canvass_Form::find($id);

        // Check if the record exists
        if (!$abstractOfCanvassForm) {
            abort(404, 'Abstract of Canvass Form not found');
        }

        // Create HTML content for PDF
        $html = "<h1>Abstract of Canvass Form</h1>";
        $html .= "<p>Approved Budget Contract: $abstractOfCanvassForm->approved_budget_contract</p>";
        $html .= "<p>Particulars: $abstractOfCanvassForm->particulars</p>";
        $html .= "<p>Quantity: $abstractOfCanvassForm->quantity</p>";
        $html .= "<p>Unit: $abstractOfCanvassForm->unit</p>";
        $html .= "<p>ABC in Table: $abstractOfCanvassForm->abc_in_table</p>";
        $html .= "<p>Supplier Company Name: $abstractOfCanvassForm->supplier_company_name</p>";
        $html .= "<p>Supplier Address: $abstractOfCanvassForm->supplier_address</p>";
        $html .= "<p>Supplier Contact No: $abstractOfCanvassForm->supplier_contact_no</p>";
        $html .= "<p>Unit Price Each Supplier: $abstractOfCanvassForm->unit_price_each_supplier</p>";
        $html .= "<p>Amount Each Supplier: $abstractOfCanvassForm->amount_each_supplier</p>";
        $html .= "<p>Sub Total Each Supplier: $abstractOfCanvassForm->sub_total_each_supplier</p>";
        $html .= "<p>Unit Price Average: $abstractOfCanvassForm->unit_price_average</p>";
        $html .= "<p>Amount Average: $abstractOfCanvassForm->amount_average</p>";
        $html .= "<p>Sub Total Average: $abstractOfCanvassForm->sub_total_average</p>";

        // Create Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF to browser
        return $dompdf->stream("abstract_of_canvass_form.pdf");
    }
}
