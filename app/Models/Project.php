<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $table = 'projects';

    protected $fillable =
    [
        'project_title',
        'department',
        'project_description',
        'person_in_charge',
        'quarter',
        'project_start',
        'project_end',
        'project_type',
        'alloted_project_cost',
        'project_status',
    ];


    public function project_document()
    {
        return $this->hasMany(ProjectDocument::class);
    }

    public function purchase_request_form()
    {
        return $this->hasMany(Purchase_Request_Form::class);
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function price_quotation()
    {
        return $this->hasMany(PriceQuotation::class);
    }

    public function material_cost_estimates()
    {
        return $this->hasMany(MaterialCostEstimates::class);
    }

    public function market_studies()
    {
        return $this->hasMany(MarketStudies::class);
    }

}
