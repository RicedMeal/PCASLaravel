<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplementaryDocument extends Model
{
    use HasFactory;

    protected $table = 'supplementary_documents';

    protected $fillable = [
        'project_id',
        'project_title',
        'department_office',
        'project_date',
        'file_name',
        'file_content',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
