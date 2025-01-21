<?php

namespace Modules\SupplierManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PurchaseManagement\Models\Purchase;

// use Modules\SupplierManagement\Database\Factories\SupplierFactory;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'supplier_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'contact_info',
        'address',
    ];
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id', 'supplier_id');
    }

    // protected static function newFactory(): SupplierFactory
    // {
    //     // return SupplierFactory::new();
    // }
}
