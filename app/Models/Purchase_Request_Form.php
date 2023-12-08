<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_Request_Form extends Model
{
    use HasFactory;

    protected $table = 'purchase_request_form';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
