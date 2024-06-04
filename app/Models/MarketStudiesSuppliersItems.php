<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketStudiesSuppliersItems extends Model
{
    use HasFactory;

    protected $table = 'supplier_items';

    protected $fillable = [
        'unit_price',
        'amount',
        'market_studies_items_id',
        'market_studies_id',
        'market_studies_supplier_id'
    ];

    public function market_studies_items()
    {
        return $this->belongsTo(MarketStudiesItems::class);
    }

    public function market_studies()
    {
        return $this->belongsTo(MarketStudies::class);
    }

    public function market_studies_supplier()
    {
        return $this->belongsTo(MarketStudiesSupplier::class);
    }

}
