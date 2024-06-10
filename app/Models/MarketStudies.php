<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketStudies extends Model
{
    use HasFactory;

    protected $table = 'market_studies';

    protected $fillable = [
        'project_id',
        'end_user',
        'abc',
        'average_subtotal',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function market_studies_items()
    {
        return $this->hasMany(MarketStudiesItems::class, 'market_studies_id');
    }

    public function market_studies_supplier()
    {
        return $this->hasMany(MarketStudiesSupplier::class, 'market_studies_id');
    }

    public function purchase_request_form()
    {
        return $this->hasMany(Purchase_Request_Form::class, 'market_studies_id');
    }


}
