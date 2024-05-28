<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;

    protected $table = 'supplies';

    protected $fillable = [
        'stock_no',
        'description',
        'unit',
        'delivered',
        'issued',
        'balance_after',
        'status',
        'date_issuance',
        'requesting_office',
        'report_no',
        'ris_no',
        'delivery_date',
        'actual_delivery_date',
        'acceptance_date',
        'iar_no',
        'item_no',
        'dr_no',
        'check_no',
        'po_no',
        'po_date',
        'po_amount',
        'pr_no',
        'price_per_purchase_request',
        'bur',
        'remarks',
        'added'
    ];

    protected $dates = [
        'date_issuance',
        'delivery_date',
        'actual_delivery_date',
        'acceptance_date',
        'po_date',
        'deleted_at'
    ];


}
