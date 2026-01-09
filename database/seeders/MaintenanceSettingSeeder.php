<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Str;

class MaintenanceSettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'maintenance_mode'],
            [
                'value' => '0',
                'type' => 'boolean'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'admin_bypass_token'],
            [
                'value' => Str::random(32),
                'type' => 'text'
            ]
        );
    }
}