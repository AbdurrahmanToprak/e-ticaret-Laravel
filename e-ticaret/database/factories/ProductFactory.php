<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryId = [1,2,3,4,5,6,7,8,9];
        $sizeList = ['XS','S','L','M','Xl'];
        $colors = ['Siyah','Beyaz','Gri','Mavi','Kırmızı'];

        $sizeText = $sizeList[random_int(0,4)];
        $colorText = $colors[random_int(0,3)];

        return [

            'name' => $colorText.' '.$sizeText.' Urun',
            'category_id' => $categoryId[random_int(0,8)],
            'price' => random_int(10,900),
            'size' => $sizeText,
            'color' => $colorText,
            'piece' => 1,
            'short_text' => $categoryId[random_int(0,8)].' id li urun',
            'status' => '1',
            'content' => 'İçerik',
        ];
    }
}
