<?php

use App\Models\SettingGroup;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'generalSettings' => [
                ['name' => 'app_name', 'value' => 'CoffeeDev', 'default_value' => 'CoffeeDev', 'type' => 'text', 'comment' => null, 'required' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'app_description', 'value' => 'CoffeeDev App', 'default_value' => 'CoffeeDev App', 'type' => 'textarea', 'comment' => null, 'required' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'app_logo', 'value' => null, 'default_value' => null, 'type' => 'file', 'comment' => null, 'required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'favicon', 'value' => null, 'default_value' => null, 'type' => 'file', 'comment' => null, 'required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'app_author', 'value' => 'Rio Prastiawan', 'default_value' => 'Rio Prastiawan', 'type' => 'text', 'comment' => null, 'required' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ['name' => 'app_version', 'value' => '0.0.1-alpha', 'default_value' => '0.0.1-alpha', 'type' => 'text', 'comment' => null, 'required' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ],
        ];

        foreach ($settings['generalSettings'] as $setting) {
            $settingGroup = SettingGroup::find(['id' => 1])->first();
            $settingGroup->settings()->create($setting);
        }
    }
}
