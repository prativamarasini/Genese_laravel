<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $category = Category::create([
            'name'=>'footwear',
            'description'=>'This category contains footwears',
            'id'=>5

        ]);

        Product::factory(5)->create([
            'category_id'=>3
        ]);
    }
}
