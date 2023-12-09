<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';

    protected $fillable = [
        'project_id',
        'project_name',
        'supplier_name',
        'address',
        'tel_no',
        'fax_no',
        'website',
        'contact_person',
        'email',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
