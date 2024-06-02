<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MarketStudiesSupplier extends Model
{
    use HasFactory;

    protected $table = 'market_studies_supplier';

    protected $fillable = [
        'supplier_name',
        'supplier_address',
        'supplier_contact',
        'unit_price',
        'amount',
        'subtotal',
        'market_studies_items_id',
        'market_studies_id',
    ];

    public function market_studies_items(): BelongsToMany
    {
        return $this->belongsToMany(MarketStudiesItems::class);
    }

    public function market_studies()
    {
        return $this->belongsTo(MarketStudies::class);
    }

}
