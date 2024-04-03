<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectDocument extends Model
{
    use HasFactory;

    protected $table = 'project_documents';

    protected $fillable = [
        'project_id',
        'purchase_request',
        'purchase_request_file_name',
        'purchase_request_number',
        'purchase_request_number_file_name',
        'price_quotation',
        'price_quotation_file_name',
        'abstract_of_canvass',
        'abstract_of_canvass_file_name',
        'material_and_cost_estimates',
        'material_and_cost_estimates_file_name',
        'budget_utilization_request',
        'budget_utilization_request_file_name',
        'project_initiation_proposal',
        'project_initiation_proposal_file_name',
        'annual_procurement_plan',
        'annual_procurement_plan_file_name',
        'purchase_order',
        'purchase_order_file_name',
        'market_study',
        'market_study_file_name',
        'certificate_of_fund_allotment',
        'certificate_of_fund_allotment_file_name',
        'complete_staff_work',
        'complete_staff_work_file_name',
        'accomplishment_report',
        'accomplishment_report_file_name',
    ];

    protected $casts = [
        'supplementary_document' => 'array',
        'supplementary_document_file_name' => 'array',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    //retrieve all pdf files connected with the project document
    public function getAllPdfs()
    {
        $pdfs = [];
        foreach ($this->fillable as $column) {
            if ($this->$column !== null) {
                $pdfs[$column] = $this->$column;
            }
        }
        return $pdfs;
    }
    
}
