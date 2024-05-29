<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFMO_Supplies extends Model
{
    use HasFactory;

    protected $table = 'pfmo_supplies';
    protected $primaryKey = 'stock_no'; // Set the primary key to 'stock_no'
    public $incrementing = false; // Set incrementing to false because it's not a numeric key
    protected $keyType = 'string';

    protected $fillable = [
        'stock_no',
        'unit',
        'description',
        'quantity',
    ];
}
