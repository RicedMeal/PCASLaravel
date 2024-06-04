<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MarketStudiesItems extends Model
{
    use HasFactory;

    protected $table = 'market_studies_items';

    protected $fillable = [
        'item_no',
        'particulars',
        'unit',
        'quantity',
    ];

    public function market_studies_supplier(): BelongsToMany
    {
        return $this->belongsToMany(MarketStudiesSupplier::class);
    }

    public function market_studies()
    {
        return $this->belongsTo(MarketStudies::class);
    }

    public function suppliers_items(): BelongsToMany
    {
        return $this->belongsToMany(MarketStudiesSuppliersItems::class);
    }
}
