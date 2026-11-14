<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'slug',
        'price',
        'store_id',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'store_id' => 'integer',
        'category_id' => 'integer',
    ];


    // Accessor
    public function getImageUrlAttribute() // $this->image_url
    {
        // https , http
        if (Str::startsWith($this->image_path, ['https', 'http'])) {
            return $this->image_path;
        }
        // null
        if (!$this->image_path) {
            return asset('assets/img/default-150x150.png');
        }
        // storage
        return asset('storage/' . $this->image_path);
        // return Storage::disk('public')->path($this->image_path);
    }


    // Relationship
    public function category() : BelongsTo 
    {
        return $this->belongsTo(Category::class);
    }
}
