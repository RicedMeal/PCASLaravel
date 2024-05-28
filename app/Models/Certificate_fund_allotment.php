<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate_fund_allotment extends Model
{
    use HasFactory;
    protected $table = 'certificate_fund_allotment';

    protected $fillable =
    [
        'certificate_fund_allotment',
        'certificate_fund_allotment_file_name'
    ];

}
