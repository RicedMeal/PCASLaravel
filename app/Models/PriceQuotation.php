<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceQuotation extends Model
{
    use HasFactory;

    protected $table = 'price_quotations';

    protected $fillable =
    [
        'project_title',
        'project_date',
        'supplier_id',
        'supplier_name',
        'address',
        'tel_no',
        'fax_no',
        'website',
        'contact_person',
        'email',
        'item',
        'quantity',
        'unit',
        'unit_price',
        'amount',
        'total',
        'vat',
        'total_amount',
        'delivery',
        'warranty',
        'validity',
        'remarks',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
