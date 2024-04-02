<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCostEstimatesItems extends Model
{
    use HasFactory;

    protected $table = 'material_cost_estimates_items';

    protected $fillable = [
        'material_cost_estimates_id',
        'item_no',
        'description',
        'unit',
        'quantity',
        'unit_cost',
        'amount'
    ];

    public function material_cost_estimates()
    {
        return $this->belongsTo(MaterialCostEstimates::class);
    }

}
