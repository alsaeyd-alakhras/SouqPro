<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::get()->first();
        if(!$user) {
            return;
        }
        $name = 'PalSotre';
        $slug = Str::slug($name);

        Store::create([
            'name' => $name,
            'slug' => $slug,
            'user_id' => $user->id,
        ]);
    }
}
