<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstract_of_Canvass_Form extends Model
{
    use HasFactory;

    protected $table = 'abstract_of_canvass_form';

    protected $fillable = [
        'project_title',
        'project_date',
        'approved_budget_contract',
        'end_user',
        'particulars',
        'quantity',
        'unit',
        'abc_in_table',
        'supplier_company_name',
        'supplier_address',
        'supplier_contact_no',
        'unit_price_each_supplier',
        'amount_each_supplier',
        'sub_total_each_supplier',
        'unit_price_average',
        'amount_average',
        'sub_total_average',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
