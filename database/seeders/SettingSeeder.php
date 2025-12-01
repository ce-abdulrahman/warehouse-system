<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'system_name', 'value' => 'Laravel WMS'],
            ['key' => 'currency', 'value' => '$'],
            ['key' => 'timezone', 'value' => 'UTC'], // Default Timezone
            ['key' => 'direction', 'value' => 'ltr'], // ltr or rtl
            ['key' => 'logo', 'value' => ''],          // Path to image
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
