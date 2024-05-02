<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageMedia extends Model
{
    use HasFactory;
    protected $fillable = ['table_id', 'model_name' , 'data'];

    protected $casts = [
        'data' => 'array',
    ];
}
