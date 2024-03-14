<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'image',
        'category_id',
        'price',
        'size',
        'color',
        'piece',
        'short_text',
        'status',
        'content',
    ];
}
