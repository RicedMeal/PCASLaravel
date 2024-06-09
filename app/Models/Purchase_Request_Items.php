<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Request_Items extends Model
{
    use HasFactory;

    protected $table = 'purchase_request_items';

    protected $fillable =
    [   
        'purchase_request_form_id',
        'unit',
        'item_no',
        'item_description',
        'quantity',
        'estimate_unit_cost',
        'estimate_cost'
    ];

    public function purchase_request_form()
    {
        return $this->belongsTo(Purchase_Request_Form::class);
    }
}
