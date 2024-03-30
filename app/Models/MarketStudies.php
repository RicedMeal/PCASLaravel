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
        'market_study_title'
    ];


    public function market_study_links()
    {
        return $this->hasMany(Market_Study_Links::class, 'market_study_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
