<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name' => 'Toprak Shop E-Ticaret',
            'content' => 'Hakkımızda Yazısı Burada',
            'text_1_icon' => 'icon-truck',
            'text_1' => 'Ücretsiz Kargo',
            'text_1_content' => 'Ürünleriniz ücretsiz ve güvenli bir şekilde evinize teslim edilir.',
            'text_2_icon' => 'icon-refresh2',
            'text_2' => 'Geri İade',
            'text_2_content' => '30 gün içerisinde ürünlerinizi iade edebilirsiniz.',
            'text_3_icon' => 'icon-help',
            'text_3' => 'Müşteri Destek',
            'text_3_content' => '7/24 bize ulaşabilirsiniz.',
        ]);
    }
}
