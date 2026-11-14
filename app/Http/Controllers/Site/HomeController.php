<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->select('name','price','slug','image_path','category_id')->take(8)->get();
        return view('site.index', compact('products'));
    }
}
