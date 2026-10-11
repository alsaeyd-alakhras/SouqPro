<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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


    // Accessor
    public function getImageUrlAttribute() // $this->image_url
    {
        // https , http 
        if(Str::startsWith($this->image_path,['https','http'])){
            return $this->image_path;
        }
        // null
        if(!$this->image_path){
            return asset('assets/img/default-150x150.png');
        }
        // storage
        return asset('storage/'.$this->image_path);
        // return Storage::disk('public')->path($this->image_path);
    }
}
