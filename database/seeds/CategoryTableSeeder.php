<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["cat one" ,'cat two', 'cat three'];
        foreach ($categories as $category) {
            Category::create([
                'ar' => ['name' => $category],
                'en' => ['name' => $category]
            ]);
        }
    }
}
