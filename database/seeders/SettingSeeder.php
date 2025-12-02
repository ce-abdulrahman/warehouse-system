<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::setValue('system_name', 'Warehouse Monitoring System');
        Setting::setValue('system_logo', '/assets/images/logo-dark.png');
        Setting::setValue('currency', '$');
        Setting::setValue('currency_dir', 'ltr');
        Setting::setValue('gui_dir', 'ltr');
        Setting::setValue('theme', 'light');
    }
}
