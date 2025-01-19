<?php

namespace Modules\SupplierManagement\Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierManagementDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
        $this->call(SupplierSeeder::class);
    }
}
