<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;

    protected $table = 'requisition';

    protected $fillable = [
        'project_id',
        'division',
        'office',
        'responsibility_center_code',
        'ris_no',
        'sai_no',
        'date',
        'purpose',
        'requested_by_name',
        'requested_by_designation',
        'approved_by_name',
        'approved_by_designation',
        'issued_by_name',
        'issued_by_designation',
        'received_by_name',
        'received_by_designation',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function requisition_items()
    {
        return $this->hasMany(Requisition_Items::class, 'requisition_id');
    }
}
