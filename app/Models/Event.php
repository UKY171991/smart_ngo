<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'event_date',
        'location',
        'fees',
        'max_participants',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            $event->slug = Str::slug($event->title) . '-' . uniqid();
        });
    }
}
