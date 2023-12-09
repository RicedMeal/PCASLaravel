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
        'department',
        'pr_no',
        'date',
        'section',
        'sai_no',
        'bus_no',
        'unit',
        'item_description',
        'quantity',
        'estimate_unit_cost',
        'estimate_cost',
        'total',
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
}
