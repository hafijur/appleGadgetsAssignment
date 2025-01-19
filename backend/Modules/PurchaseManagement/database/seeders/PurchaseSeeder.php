<?php

namespace Modules\PurchaseManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PurchaseManagement\Models\Purchase;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        Purchase::insert([
            [
                'supplier_id' => 1,
                'total_amount' => 1000,
                'purchase_date' => '2025-01-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 2,
                'total_amount' => 2000,
                'purchase_date' => '2025-01-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 3,
                'total_amount' => 3000,
                'purchase_date' => '2025-01-21',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
