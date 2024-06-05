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
        'sub_total',
    ];

    public function ms_supplier_items()
    {
        return $this->hasMany(MarketStudiesSupplierItems::class, 'market_studies_supplier_id');
    }

}
