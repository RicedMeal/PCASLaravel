<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
  
  	protected $table = 'suppliers';

    protected $fillable = [
      	'Suppliers_id',
        'name',
        'category',
        'address',
        'contact_number',
        'email',
        'representative_name',
        'representative_contact_number',
        'representative_email',

    ];
}
