<?php

namespace Modules\PurchaseManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\SupplierManagement\Models\Supplier;

// use Modules\PurchaseManagement\Database\Factories\PurchaseFactory;

class Purchase extends Model
{
    protected $primaryKey = 'purchase_id';

    protected $fillable = [
        'supplier_id',
        'total_amount',
        'purchase_date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id');
    }
}
