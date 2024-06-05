<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockCard extends Model
{
    use HasFactory;

    protected $table = 'stock_card';

    protected $fillable = [
        'entity_name',
        'fund_cluster',
        'item_code',
        'item_description',
        'unit',
        'stock_no',
        'reorder_point',
    ];

    public function stock_card_list()
    {
        return $this->hasMany(StockCardList::class);
    }
}
