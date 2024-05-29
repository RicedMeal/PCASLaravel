<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bur extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'bur';

    // Specify the primary key if different from 'id'
    protected $primaryKey = 'bur_no';

    // The attributes that are mass assignable
    protected $fillable = [
        'date',
        'payee',
        'office',
        'address',
        'responsibility_center',
        'account_code',
        'particulars',
        'amount',
        'disbursement_voucher',
        'certificate_of_funds_availability',
        'purchase_order',
        'purchase_request',
        'completed_staff_work'
    ];

    // The attributes that should be hidden for arrays
    protected $hidden = [];

    // The attributes that should be cast to native types
    protected $casts = [
        'date' => 'date',
        'ammount' => 'decimal:2'
    ];
}
