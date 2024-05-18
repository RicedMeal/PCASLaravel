<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition_Items extends Model
{
    use HasFactory;

    protected $table = 'requisition_items';

    protected $fillable = [
        'stock_no',
        'requisition_id',
        'unit',
        'description',
        'quantity',
    ];

    public function requisition()
    {
        return $this->belongsTo(Requisition::class);
    }
}
