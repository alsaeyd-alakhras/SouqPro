<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Clotes',
                'is_active' => true,
                'description' => '----',
            ],
            [
                'name' => 'Ilectroic',
                'is_active' => false,
            ],
            [
                'name' => 'Books',
            ],
        ];


        foreach ($categories as $categoy) {
            Category::create(array_merge($categoy,['slug'=>Str::slug($categoy['name'])]));
        }
    }
}
