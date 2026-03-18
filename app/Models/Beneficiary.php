<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'details',
        'help_history',
    ];
}
