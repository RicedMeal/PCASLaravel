<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketStudiesSupplierItems extends Model
{
    use HasFactory;

    protected $table = 'ms_supplier_items';

    protected $fillable = [
        'market_studies_items_id',
        'market_studies_supplier_id',
        'unit_price',
        'quantity',
        'amount_per_supplier',
    ];

    public function market_studies_items()
    {
        return $this->belongsTo(MarketStudiesItems::class);
    }

    public function market_studies_supplier()
    {
        return $this->belongsTo(MarketStudiesSupplier::class);
    }

}
