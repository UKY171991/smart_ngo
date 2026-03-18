<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 
        'goal_amount', 'current_amount', 
        'start_date', 'end_date', 'image', 'is_active'
    ];
}
