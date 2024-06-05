<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MarketStudies extends Model
{
    use HasFactory;

    protected $table = 'market_studies';

    protected $fillable = [
        'project_id',
        'end_user',
        'abc',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function market_studies_items()
    {
        return $this->hasMany(MarketStudiesItems::class, 'market_studies_id');
    }
}
