<?php

namespace App\Http\Controllers;

use App\Models\StockCard;
use App\Models\StockCardList;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class StockCardController extends Controller
{
    public function pdf($stockId)
    {
        //retrieve material cost estimates form data
        $stockCard = StockCard::where('id', $stockId)->first();

        //retrieve material cost estimates items data
        $stockCardLists = StockCardList::where('stock_card_id', $stockCard->id)->get();

        //$stockCard->load('project');

        //pass data to the view
        $data = compact('stockCard', 'stockCardLists');

        //generate PDF
        $pdf = PDF::loadView('pdf.stock_card_pdf', $data);

        //set headers for download
        return $pdf->stream('stock_card.pdf'); //download for automatic download and stream for viewing in browser
    }
}
