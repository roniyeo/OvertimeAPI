<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new Setting;
        $setting->key = 'overtime_method';
        $setting->value = 1;
        $setting->expression = '(salary / 173) * overtime_duration_total'; 
        $setting->save();
    }
}
