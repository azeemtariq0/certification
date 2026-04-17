<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'company_name',
        'certificate_no',
        'standard',
        'scope',
        'issue_date',
        'expiry_date',
        'status'
    ];
}
