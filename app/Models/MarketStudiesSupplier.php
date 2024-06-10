<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketStudiesSupplier extends Model
{
    use HasFactory;

    protected $table = 'market_studies_supplier';

    protected $fillable = [
        'market_studies_id',
        'supplier_name',
        'supplier_address',
        'supplier_contact',
        'sub_total',
    ];

    public function ms_supplier_items()
    {
        return $this->hasMany(MarketStudiesSupplierItems::class, 'market_studies_supplier_id');
    }

    public function market_studies()
    {
        return $this->belongsTo(MarketStudies::class);
    }

    public function market_studies_items()
    {
        return $this->hasMany(MarketStudiesItems::class, 'market_studies_items_id');
    }
}
