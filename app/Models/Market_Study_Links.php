<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Market_Study_Links extends Model
{
    use HasFactory;

    protected $table = 'market_study_links';

    protected $fillable = [
        'market_study_id',
        'market_study_url',
        'market_study_url_description'
    ];



    public function marketstudies()
    {
        return $this->belongsTo(MarketStudies::class);
    }
}
