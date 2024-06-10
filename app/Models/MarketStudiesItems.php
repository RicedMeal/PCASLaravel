<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketStudiesItems extends Model
{
    use HasFactory;

    protected $table = 'market_studies_items';

    protected $fillable = [
        'item_no',
        'particulars',
        'unit',
        'quantity',
        'average_unit_price',
        'average_amount',
        'market_studies_id',
    ];

    public function market_studies()
    {
        return $this->belongsTo(MarketStudies::class);
    }

    public function market_studies_supplier_items() 
    {
        return $this->hasMany(MarketStudiesSupplierItems::class, 'market_studies_items_id');
    }

    public function market_studies_supplier() 
    {
        return $this->hasMany(MarketStudiesSupplier::class, 'market_studies_items_id');
    }

    public function purchase_request_form() 
    {
        return $this->hasMany(Purchase_Request_Form::class, 'market_studies_items_id');
    }
    
}
