<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFMO_Supplies extends Model
{
    use HasFactory;

    protected $table = 'pfmo_supplies';

    protected $fillable = [
        'stock_no',
        'unit',
        'description',
        'quantity',
    ];
}
