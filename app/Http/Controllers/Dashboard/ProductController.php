<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Product::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', "%{$search}%");
        })->paginate(10)->withQueryString();

        $stores = Store::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('dashboard.products.index', compact('products', 'stores', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product;
        $stores = Store::orderBy('name')->get();
        $categories = Category::where('is_active', true)->orderBy('name')->get();

        return view('dashboard.products.create', compact('product', 'stores', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'nullable|exists:categories,id',
            'image_path' => 'nullable|image|max:10240',
        ], [
            'image_path.uploaded' => 'The image could not be uploaded. The maximum allowed size is 10 MB.',
            'image_path.image' => 'The selected file must be an image.',
            'image_path.max' => 'The image may not be larger than 10 MB.',
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug.'-'.$count;
            $count++;
        }

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = now()->format('Y-m-d_H-i-s').'_'.uniqid().'.'.$image->extension();
            $imagePath = $image->storeAs('products', $imageName, 'public');

            $request->merge(['image_path' => $imagePath]);
        }

        $request->merge(['slug' => $slug]);
        Product::create($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'The Product New Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $stores = Store::orderBy('name')->get();
        $categories = Category::where('is_active', true)
            ->orWhere('id', $product->category_id)
            ->orderBy('name')
            ->get();

        return view('dashboard.products.edit', compact('product', 'stores', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'nullable|exists:categories,id',
            'image_path' => 'nullable|image|max:10240',
        ], [
            'image_path.uploaded' => 'The image could not be uploaded. The maximum allowed size is 10 MB.',
            'image_path.image' => 'The selected file must be an image.',
            'image_path.max' => 'The image may not be larger than 10 MB.',
        ]);

        if ($request->name !== $product->name) {
            $slug = Str::slug($request->name);
            $originalSlug = $slug;
            $count = 1;

            while (Product::where('id', '<>', $product->id)->where('slug', $slug)->exists()) {
                $slug = $originalSlug.'-'.$count;
                $count++;
            }

            $request->merge(['slug' => $slug]);
        }

        $oldImage = $product->image_path;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = now()->format('Y-m-d_H-i-s').'_'.uniqid().'.'.$image->extension();
            $imagePath = $image->storeAs('products', $imageName, 'public');

            if ($oldImage && $imagePath) {
                Storage::disk('public')->delete($oldImage);
            }

            $request->merge(['image_path' => $imagePath]);
        }

        $product->update($request->all());

        return redirect()->route('dashboard.products.index')->with('success', 'The Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $oldImage = $product->image_path;
        $product->delete();

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('dashboard.products.index')->with('error', 'The Product Deleted');
    }
}
