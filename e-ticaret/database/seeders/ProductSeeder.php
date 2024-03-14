<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name'  => 'Urun 1',
            'image'=> 'images/shoe_1.jpg',
            'category_id'   => 1,
            'price'=> 100,
            'size'=> 'Small',
            'color'=> 'Red',
            'piece'=> 2,
            'short_text'=> 'KısaBilgi',
            'status'=> '1',
            'content' => 'Urun Aciklamasi',
        ]);
        Product::create([
            'name'  => 'Urun 2',
            'image'=> 'images/cloth_2.jpg',
            'category_id'   => 2,
            'price'=> 10,
            'size'=> 'Medium',
            'color'=> 'Black',
            'piece'=> 4,
            'short_text'=> 'KısaBilgi',
            'status'=> '1',
            'content' => 'Urun Aciklamasi',
        ]);
    }
}
