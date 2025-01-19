<?php

namespace Modules\PurchaseManagement\Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseManagementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        $this->call([
            PurchaseSeeder::class,
            PurchaseItemSeeder::class,
        ]);
    }
}
