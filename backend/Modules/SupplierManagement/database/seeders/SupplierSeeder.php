<?php

namespace Modules\SupplierManagement\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SupplierManagement\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::insert([
            [
                'name' => 'Hafijur Rahman',
                'contact_info' => 'Contact Info 1',
                'address' => 'Address 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rakibul islam',
                'contact_info' => 'Contact Info 2',
                'address' => 'Address 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tarek Monoar',
                'contact_info' => 'Contact Info 3',
                'address' => 'Address 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
