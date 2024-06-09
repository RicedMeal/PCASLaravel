<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;

   protected $table = 'delivered';
    protected $primaryKey = 'id';
    protected $fillable = [
        'actual_delivery_date',
        'stock_no',
        'iar_no',
        'item_no',
        'stock_no',
        'item_description',
        'delivered',
        'unit',
        'dr_no',
        'check_no',
        'po_no',
        'po_date',
        'po_amount',
        'pr_number',
        'price_per_purchase_request',
        'bur',
        'remarks',
        'supplier',
        'photo',
    ];


}
