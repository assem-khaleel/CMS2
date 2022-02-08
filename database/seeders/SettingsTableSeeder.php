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
            Setting::create([
                'site_name' => "Laravel's Blog",
                'address' => 'Amman , Jordan',
                'contact_number' => '962779175605',
                'contact_email'=>'Jimzawi@gmail.com'
            ]);
    }
}
