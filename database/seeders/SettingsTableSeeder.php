<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        $items = [
            ['key' =>'uploaded_logo', 'value' => null],
            ['key' => 'app_title', 'value' => 'VGP Performance Evaluation'],
            ['key' => 'company_name', 'value' => 'Veritas Pension'],
            ['key' => 'company_address', 'value' => null],
            ['key' => 'company_telephone', 'value' => null],
            ['key' => 'company_email', 'value' => null],
            ['key' => 'company_website', 'value' => null],
            ['key' => 'operating_year', 'value' => '2019-01-01']
        ];

        foreach ($items as $key => $item) {
            DB::table('settings')->insert([$item, ]);
        }
    }
}
