<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $main_categories = ['Category A', 'Category B', 'Category C'];
        foreach ($main_categories as $category) {
            Category::create([
                'category_name' => $category
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            $parent_id = rand(1,3);
            Category::create([
                'parent_id' => $parent_id,
                'category_name' => 'Sub ' . $main_categories[$parent_id-1]

            ]);
        }

        for ($i = 0; $i < 10; $i++) {
            $parent_id = rand(4,8);
            Category::create([
                'parent_id' => $parent_id,
                'category_name' => 'Sub ' . (Category::find($parent_id))->category_name
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $parent_id = rand(9,18);
            Category::create([
                'parent_id' => $parent_id,
                'category_name' => 'Sub ' . (Category::find($parent_id))->category_name
            ]);
        }

    }
}
