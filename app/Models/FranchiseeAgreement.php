<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FranchiseeAgreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'business_experience',
        'ssm_certificate',
        'receipt',
        'status',
    ];
}
