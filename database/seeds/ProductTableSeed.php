<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = ['product one','product two','product three'];
        foreach ($products as $product) {
            Product::create([
                'purchase_price' => random_int(100,1000),
                'sale_price' => random_int(1500,2000),
                'stock' => random_int(1,25),
                'category_id' => 1,
                'ar' => ['name' => $product , 'description' => $product .' description'],
                'en' => ['name' => $product , 'description' => $product .' description'],
            ]);
        }
    }
}
