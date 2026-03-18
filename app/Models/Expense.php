<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'category',
        'amount',
        'bill_image',
        'description',
        'expense_date',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
