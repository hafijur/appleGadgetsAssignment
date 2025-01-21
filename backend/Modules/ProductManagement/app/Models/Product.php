<?php

namespace Modules\ProductManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\ProductManagement\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'SKU',
        'price',
        'category_id',
        'initial_stock_quantity',
        'current_stock_quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // protected static function newFactory(): ProductFactory
    // {
    //     // return ProductFactory::new();
    // }
}
