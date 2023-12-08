<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable =
    [
        'project_title',
        'department_office',
        'project_description',
        'person_in_charge',
        'project_date',
        'purchase_request',
        'price_quotation',
        'abstract_of_canvass',
        'material_and_cost_estimates',
        'budget_utilization_request',
        'project_initiation_proposal',
        'annual_procurement_plan',
        'purchase_request_with_number',
        'market_study',
        'certificate_of_fund_allotment',
        'csw',
        'accomplishment_report',
        'project_status',
    ];


    public function supplementary_documents()
    {
        return $this->belongsTo(SupplementaryDocument::class);
    }

    public function purchase_request_forms()
    {
        return $this->belongsTo(Purchase_Request_Form::class);
    }

    public function abstract_of_canvass_forms()
    {
        return $this->belongsTo(Abstract_of_Canvass_Form::class);
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function price_quotations()
    {
        return $this->belongsTo(PriceQuotation::class);
    }




}
