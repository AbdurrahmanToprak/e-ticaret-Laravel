<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Sluggable;
    use HasFactory;
    public $fillable = [
        'name',
        'image',
        'slug',
        'category_id',
        'price',
        'size',
        'color',
        'piece',
        'kdv',
        'short_text',
        'status',
        'content',
        'title',
        'description',
        'keywords',
    ];

    public function images(){
        return $this->hasOne(ImageMedia::class,'table_id', 'id')->where('model_name','Product');
    }
    public function category(){
        return $this->hasOne(Category::class, 'id' , 'category_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
