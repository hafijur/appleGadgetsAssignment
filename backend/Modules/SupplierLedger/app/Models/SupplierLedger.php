<?php

namespace Modules\SupplierLedger\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SupplierManagement\Models\Supplier;

// use Modules\SupplierLedger\Database\Factories\SupplierLedgerFactory;

class SupplierLedger extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'supplier_id',
        'transaction_date',
        'debit',
        'credit',
        'balance',
        'remarks',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
    }

    // protected static function newFactory(): SupplierLedgerFactory
    // {
    //     // return SupplierLedgerFactory::new();
    // }
}
