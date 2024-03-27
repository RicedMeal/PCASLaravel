<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'project_id',
        'item_name',
        'item_description',
        'quantity',
        'unit',
        'date_purchased',
        'supplier',
        'remarks',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
