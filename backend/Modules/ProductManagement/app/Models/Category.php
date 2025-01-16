<?php

namespace Modules\ProductManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ProductManagement\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name'
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // protected static function newFactory(): CategoryFactory
    // {
    //     // return CategoryFactory::new();
    // }
}
