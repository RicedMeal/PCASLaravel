<?php

// app\Models\AbstractOfCanvassItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Abstract_of_Canvass_Form ;

class Abstract_of_Canvass_Items extends Model
{
    use HasFactory;

    protected $table = 'abstract_of_canvass_items';

    protected $fillable = [
        'abstract_of_canvass_form_id',
        'item',
        'particulars',
        'quantity',
        'unit',
        'abc_in_table',
        'unit_price_each_supplier',
        'amount_each_supplier',
        'sub_total_each_supplier',
        'unit_price_average',
        'amount_average',
    ];

    public function abstract_of_canvass_form()
    {
        return $this->belongsTo(Abstract_of_Canvass_Form::class);
    }
}
