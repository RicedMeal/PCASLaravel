<?php

// app\Models\AbstractOfCanvassForm.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Abstract_of_Canvass_Items;

class Abstract_of_Canvass_Form extends Model
{
    use HasFactory;

    protected $table = 'abstract_of_canvass_form';

    protected $fillable = [
        'project_id',
        'approved_budget_contract',
        'supplier_company_name',
        'supplier_address',
        'supplier_contact_no',
    ];

    public function abstract_of_canvass_items()
    {
        return $this->hasMany(Abstract_of_Canvass_Items::class, 'abstract_of_canvass_form_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
