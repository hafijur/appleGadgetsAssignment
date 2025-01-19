<?php

namespace Modules\PurchaseManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PurchaseManagement\Models\PurchaseItem;

class PurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        PurchaseItem::insert([
            [
                'purchase_id' => 1,
                'product_id' => 1,
                'quantity' => 10,
                'unit_price' => 50.00,
                'total_price' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 1,
                'product_id' => 2,
                'quantity' => 5,
                'unit_price' => 30.00,
                'total_price' => 150.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'purchase_id' => 2,
                'product_id' => 3,
                'quantity' => 20,
                'unit_price' => 25.00,
                'total_price' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
