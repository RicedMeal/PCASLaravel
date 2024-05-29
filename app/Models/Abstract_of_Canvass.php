<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstract_of_Canvass extends Model
{
    use HasFactory;
    protected $table = 'abstract_of_canvass';

    

    protected $fillable = [
        'abstract_of_canvass',
        'abstract_of_canvass_file_name'
    ];
}
