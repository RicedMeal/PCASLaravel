<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCostEstimates extends Model
{
    use HasFactory;

    protected $table = 'material_cost_estimates';

    protected $fillable = [
        'project_id',
        'location',
        'total',
        'prepared_by',
        'checked_by',
        'prepared_by_designation',
        'checked_by_designation',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function material_cost_estimates_items()
    {
        return $this->hasMany(MaterialCostEstimatesItems::class, 'material_cost_estimates_id');
    }

}
