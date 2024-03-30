<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketStudies extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'market_study_title',
        'market_study_url',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
