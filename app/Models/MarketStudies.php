<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MarketStudies extends Model
{
    use HasFactory;

    protected $table = 'market_studies';

    protected $fillable = [
        'project_id',
        'subtotal_average',
        'average_unit_price',
        'total_average',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function market_studies_items(): BelongsToMany
    {
        return $this->belongsToMany(MarketStudiesItems::class);
    }

    public function market_studies_supplier(): BelongsToMany
    {
        return $this->belongsToMany(MarketStudiesSupplier::class);
    }

    public function suppliers_items(): BelongsToMany
    {
        return $this->belongsToMany(MarketStudiesSuppliersItems::class);
    }
}
