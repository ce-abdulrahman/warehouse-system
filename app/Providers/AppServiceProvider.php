<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Prevent crash if table doesn't exist yet (during migration)
        if (Schema::hasTable('settings')) {
            // 1. Get all settings as a simple Key-Value array
            $allSettings = Setting::pluck('value', 'key')->toArray();

            // 2. Share with ALL views (layout, dashboard, etc.)
            View::share('settings', $allSettings);

            // 3. Set Application Timezone dynamically
            if (isset($allSettings['timezone'])) {
                config(['app.timezone' => $allSettings['timezone']]);
                date_default_timezone_set($allSettings['timezone']);
            }
        }
    }
}
