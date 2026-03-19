<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['setting_key', 'value'];
    
    /**
     * Get setting value by key
     */
    public static function getValue($key, $default = null)
    {
        $setting = static::where('setting_key', $key)->first();
        return $setting ? $setting->value : $default;
    }
    
    /**
     * Set setting value
     */
    public static function setValue($key, $value)
    {
        return static::updateOrCreate(
            ['setting_key' => $key],
            ['value' => $value]
        );
    }
}
