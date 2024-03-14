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
        'short_text',
        'status',
        'content',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
