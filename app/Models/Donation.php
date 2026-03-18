<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'campaign_id',
        'donor_name',
        'donor_email',
        'donor_phone',
        'amount',
        'payment_method',
        'payment_gateway',
        'transaction_id',
        'receipt_number',
        'is_80G',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
