<?php

namespace Modules\SupplierLedger\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SupplierLedger\Models\SupplierLedger;

class SupplierLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        SupplierLedger::insert([
            [
                'supplier_id' => 1,
                'debit' => 100,
                'credit' => 0,
                'balance' => 100,
                'remarks' => 'Initial balance',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'supplier_id' => 1,
                'debit' => 0,
                'credit' => 50,
                'balance' => 50,
                'remarks' => 'Payment',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'supplier_id' => 1,
                'debit' => 0,
                'credit' => 50,
                'balance' => 0,
                'remarks' => 'Payment',
                'transaction_date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
