<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceQuotation extends Model
{
    use HasFactory;

    protected $table = 'price_quotations';

    protected $fillable =
    [
        'PriceQuotation',
        'PriceQuotation_file_name'
    ];


}
