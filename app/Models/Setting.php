<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type'];

    public $timestamps = true;

    // Get setting (cached)
    public static function get($key, $default = null)
    {
        return cache()->rememberForever("setting_{$key}", function () use ($key) {
            return optional(self::where('key', $key)->first())->value;
        }) ?? $default;
    }

    // Set setting
    public static function setValue($key, $value)
    {
        $setting = self::updateOrCreate(['key'=>$key], ['value'=>$value]);
        cache()->forget("setting_{$key}");
        return $setting;
    }
}
