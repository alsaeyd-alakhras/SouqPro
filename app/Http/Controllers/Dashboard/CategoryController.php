<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
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
            ->when($search, function($query, $search){
                $query->where('name',$search);
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
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validate
        $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'string|nullable',
            'is_active' => 'in:on,off'
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
        while(Category::where('slug', $slug)->exists()){
            $slug = $org_slug . '-' . $count;
            $count++;
        }
        $is_active = $request->is_active == 'on' ? 1 : 0;

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
        return redirect()->route('dashboard.categories.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
