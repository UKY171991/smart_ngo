<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'budget',
        'spent',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
