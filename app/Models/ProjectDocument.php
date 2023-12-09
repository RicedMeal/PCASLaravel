<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    use HasFactory;

    protected $table = 'project_documents';

    protected $fillable = [
        'project_id',
        'purchase_request',
        'price_quotation',
        'abstract_of_canvass',
        'material_and_cost_estimates',
        'budget_utilization_request',
        'project_initiation_proposal',
        'annual_procurement_plan',
        'purchase_order',
        'market_study',
        'certificate_of_fund_allotment',
        'complete_staff_work',
        'accomplishment_report',
        'supplementary_document',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
