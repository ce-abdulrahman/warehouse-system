<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class SettingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (\Schema::hasTable('settings')) {
            foreach (Setting::all() as $s) {
                config()->set("system.{$s->key}", $s->value);
            }
        }
    }
}
