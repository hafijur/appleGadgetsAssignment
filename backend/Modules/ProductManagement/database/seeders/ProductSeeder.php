<?php

namespace Modules\ProductManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ProductManagement\Models\Category;
use Modules\ProductManagement\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $category_ids = Category::pluck('category_id');

        Product::insert([
            [
                'name' => 'Laptop',
                'price' => 50000,
                'SKU' => 'LPTP001',
                'category_id' => $category_ids->random(),
                'initial_stock_quantity' => 10,
                'current_stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'T-shirt',
                'price' => 500,
                'SKU' => 'TSHRT001',
                'category_id' => $category_ids->random(),
                'initial_stock_quantity' => 100,
                'current_stock_quantity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PHP Programming',
                'price' => 500,
                'SKU' => 'PHP001',
                'category_id' => $category_ids->random(),
                'initial_stock_quantity' => 100,
                'current_stock_quantity' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
