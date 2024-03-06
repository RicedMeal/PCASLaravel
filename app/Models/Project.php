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
        'department',
        'project_description',
        'person_in_charge',
        'project_date',
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

    public function abstract_of_canvass_form()
    {
        return $this->hasMany(Abstract_of_Canvass_Form::class);
    }

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function price_quotation()
    {
        return $this->hasMany(PriceQuotation::class);
    }




}
