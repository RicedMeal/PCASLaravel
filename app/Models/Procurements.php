<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurements extends Model
{
    use HasFactory;

    protected $table = 'procurements';

    protected $fillable = [
     'code',
        'project',
        'category',
        'procurement_project',
        'early_procurement',
        'status',
        'source_funds',
        'mop',
        'notice_award',
        'remarks',
        'co',
        'advertisement',
        'update_details',
        'procurement_id',
        'app',
        'mooe',
        'project_type',
        'annual_procurement_plan',
        'complete_set_of_ppu',
        'total',
        'purchase_request',
        'condition_of_funds_and_availability',
        'certificate_of_funded_body',
        'submission',
        'end_user',
        'abc_uwp',
        'contract_cost',
        'date_of_receipt_of_initiation',
        'infrastructure',
        'contract_signing',
        'goods',
        'consulting',
        'posted_to',
        'procurement_lead',
        'funding_source',
        'date_of_public_bidding',
        'date_of_negotiated_procurement',
        'date_of_alternative_method',
        'date_of_evaluation_of_eligibility',
        'date_of_post_qualification',
        'date_of_notice_of_award',
        'date_of_contract_signing',
        'date_of_notice_to_proceed',
        'date_of_delivery',
        'date_of_inspection',
        'date_of_acceptance',
        'date_of_closing',
      	'amend_status',
    ];
}