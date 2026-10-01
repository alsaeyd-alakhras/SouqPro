<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // fillable
    // id, timestamps
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'description',
        'image_path'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $table = 'categories';
}
