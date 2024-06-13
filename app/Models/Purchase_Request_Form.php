<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Request_Form extends Model
{
    use HasFactory;

    protected $table = 'purchase_request_form';

    protected $fillable =
    [   'project_id',
        'market_studies_id',
        'market_studies_items_id',
        'pr_no',
        'date',
        'section',
        'sai_no',
        'bus_no',
        //'total',
        'delivery_duration',
        'purpose',
        'recommended_by_name',
        'recommended_by_designation',
        'approved_by_name',
        'approved_by_designation',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function market_studies()
    {
        return $this->belongsTo(MarketStudies::class, 'market_studies_id');
    }

    public function market_studies_items()
    {
        return $this->belongsTo(MarketStudiesItems::class, 'market_studies_items_id');
    }

}
