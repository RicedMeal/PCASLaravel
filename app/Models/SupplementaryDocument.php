<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementaryDocument extends Model
{
    use HasFactory;

    protected $table = 'supplementary_documents';

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
