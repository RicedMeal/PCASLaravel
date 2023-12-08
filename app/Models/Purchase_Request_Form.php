<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Request_Form extends Model
{
    use HasFactory;

    protected $table = 'purchase_request_form';

    protected $fillable =
    [
        'project_title',
        'project_date',
        'department_office',
        'project_description',
        'person_in_charge',
        'purpose',
        'date_required',
        'mode_of_procurement',
        'source_of_fund',
        'abc',
        'date_of_purchase_request',
        'date_of_price_quotation',
        'date_of_abstract_of_canvass',
        'date_of_budget_utilization_request',
        'date_of_project_initiation_proposal',
        'date_of_annual_procurement_plan',
        'date_of_purchase_request_with_number',
        'date_of_market_study',
        'date_of_certificate_of_fund_allotment',
        'date_of_csw',
        'date_of_accomplishment_report',
        'date_of_project_status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
