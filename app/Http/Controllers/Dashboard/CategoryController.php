<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Clotes LINK ote
        $search = $request->query('search');
        // if ($search) {
        //     // SELECT * FORM `categories` WHERE `is_active` = 1; 
        //     $categories = Category::where('is_active', true)
        //         // ->where('name','LIKE',"%{$search}%")
        //         ->where('name', $search)
        //         ->get();
        // } else {
        //     $categories = Category::where('is_active', true)
        //         // ->where('name','LIKE',"%{$search}%")
        //         ->get();
        // }
        // $categories = Category::query();
        // $categories = Category::where('is_active', true);
        // // $categories->where('is_active', true);

        // if($search){
        //     $categories->where('name', $search);
        // }

        // $categories = $categories->get();

        $categories = Category::where('is_active', true)
            // ->where('name','LIKE',"%{$search}%")
            // ->wher('name', $search)
            ->when($search, function ($query, $search) {
                $query->where('name', $search);
            })
            ->get();

        // $categories = Category::whereIn('slug', ['clotes','books'])->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        return view('dashboard.categories.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // validate
        $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'string|nullable',
            'is_active' => 'in:on,off',
            'image_path' => 'file|image'
        ]);

        // code
        $name = $request->name;
        $slug = Str::slug($name);
        $org_slug = $slug;
        $count = 1;
        // $check_slug = Category::where('slug', $slug);
        // if($check_slug){
        //     $slug = $slug . '1';
        // }
        while (Category::where('slug', $slug)->exists()) {
            $slug = $org_slug . '-' . $count;
            $count++;
        }
        $is_active = $request->is_active == 'on' ? 1 : 0;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $time = now()->format('Y-m-d_H-i-s');
            $image_name = $time . '_' .  uniqid() . '.' . $image->extension();
            // $image_path = $image->store('categories','public');
            $image_path = $image->storeAs('categories', $image_name, 'public');
            $request->merge([
                'image_path' => $image_path,
            ]);
        }

        $request->merge([
            'slug' => $slug,
            'is_active' => $is_active,
        ]);
        // create
        // Category::create([
        //     'name' => $name,
        //     'slug' => $slug,
        //     'description' => $request->description,
        //     'is_active' => $is_active,
        // ]);
        $category = Category::create($request->all());

        // redirct
        return redirect()->route('dashboard.categories.index')->with('success', 'the Category New Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $category = Category::find($id);
        // if(!$category){
        //     return redirect()->route('dashboard.categories.index');
        // }
        $category = Category::findOrFail($id);
        // dd($category);
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // dd($request->all(),$category);
        // validate
        $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'string|nullable',
            'is_active' => 'in:on,off',
            'image_path' => 'file|image'
        ]);

        // code
        $name = $request->name;
        // Nore  Store => nore-sotre
        if ($name != $category->name) {
            $slug = Str::slug($name);
            $org_slug = $slug;
            $count = 1;
            while (Category::where('id', '<>', $category->id)->where('slug', $slug)->exists()) {
                $slug = $org_slug . '-' . $count;
                $count++;
            }
            $request->merge([
                'slug' => $slug,
            ]);
        }

        $is_active = $request->is_active == 'on' ? 1 : 0;
        $request->merge([
            'is_active' => $is_active,
        ]);

        $image_old = $category->image_path;
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $time = now()->format('Y-m-d_H-i-s');
            $image_name = $time . '_' .  uniqid() . '.' . $image->extension();
            // $image_path = $image->store('categories','public');
            $image_path = $image->storeAs('categories', $image_name, 'public');
            if ($image_old && $image_path) {
                Storage::disk('public')->delete($image_old);
            }
            $request->merge([
                'image_path' => $image_path,
            ]);
        }

        // dd($request->all());
        // edit
        $category = $category->update($request->all());

        // redirct
        return redirect()->route('dashboard.categories.index')->with('success', 'the Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $image_old = $category->image_path;
        $category->delete();
        if ($image_old) {
            Storage::disk('public')->delete($image_old);
        }
        return redirect()->route('dashboard.categories.index')->with('error', 'The Category Deleted');
    }
}
