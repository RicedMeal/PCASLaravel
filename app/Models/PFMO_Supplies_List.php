<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFMO_Supplies_List extends Model
{
    use HasFactory;

    protected $table = 'pfmo_supplies_list';

    protected $fillable = [
        'stock_no',
        'unit',
        'custom_code',
        'description',
        'quantity',
    ];

    public function pfmo_supplies()
    {
        return $this->belongsTo(PFMO_Supplies::class);
    }
}
