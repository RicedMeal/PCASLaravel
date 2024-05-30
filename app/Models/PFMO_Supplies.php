<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFMO_Supplies extends Model
{
    use HasFactory;

    protected $table = 'pfmo_supplies';

    protected $fillable = [
        'entry_date',
        'user',
        'custom_code',
    ];

    protected $casts = [
        'entry_date' => 'date', // Ensuring entry_date is treated as a date
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($supply) {
            if ($supply->entry_date) {
                $supply->custom_code = $supply->entry_date->format('Y') . '_' . $supply->id;
                $supply->save();
            }
        });
    }

    public function getYearAttribute()
    {
        return $this->date->format('Y');
    }

    public function pfmo_supplies_list()
    {
        return $this->hasMany(PFMO_Supplies_List::class, 'pfmo_supplies_id');
    }
}
