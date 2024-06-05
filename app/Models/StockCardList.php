<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCardList extends Model
{
    use HasFactory;

    protected $table = 'stock_card_list';

    protected $fillable = [
        'stock_card_id',
        'date',
        'reference',
        'receipt_quantity',
        'issue_quantity',
        'issue_office',
        'balance_quantity',
        'no_of_days',
    ];

    public function stockCard()
    {
        return $this->belongsTo(StockCard::class);
    }
}
