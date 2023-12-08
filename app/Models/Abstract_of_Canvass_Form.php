<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abstract_of_Canvass_Form extends Model
{
    use HasFactory;

    protected $table = 'abstract_of_canvass_form';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
