<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
           'name' => 'adress',
           'data' => 'Adres Bilgileri Burada',
        ]);
        SiteSetting::create([
            'name' => 'phone',
            'data' => '0 523 232 23 23',
        ]);
        SiteSetting::create([
            'name' => 'e-mail',
            'data' => 'toprakshop@domain.com',
        ]);
        SiteSetting::create([
            'name' => 'map',
            'data' => null,
        ]);
    }
}
