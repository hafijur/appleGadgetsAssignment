<?php

namespace Modules\ProductManagement\Services;

use Modules\ProductManagement\Models\Product;
use Modules\ProductManagement\Services\Contracts\ProductContract;

class ProductService implements ProductContract
{
    public function listProducts(array $filters, int $page = 10): array
    {
        $query = Product::query();

        if (! empty($filters['name'])) {
            $query->where('name', 'like', '%'.$filters['name'].'%');
        }

        if (! empty($filters['SKU'])) {
            $query->where('SKU', 'like', '%'.$filters['SKU'].'%');
        }

        if (! empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        $paginated = $query->with('category')->paginate($page);

        return [
            'data' => $paginated->items(),
            'meta' => [
                'current_page' => $paginated->currentPage(),
                'per_page' => $paginated->perPage(),
                'total' => $paginated->total(),
                'last_page' => $paginated->lastPage(),
                'prev_page_url' => $paginated->previousPageUrl(),
                'next_page_url' => $paginated->nextPageUrl(),
            ],
        ];
    }

    public function createProduct(array $data): object
    {
        $data['current_stock_quantity'] = $data['initial_stock_quantity'];

        return Product::create($data);
    }

    public function updateProduct(int $productId, array $data): object
    {
        $product = Product::findOrFail($productId);
        $product->update($data);

        return $product;
    }

    public function deleteProduct(int $productId): bool
    {
        $product = Product::findOrFail($productId);

        return $product->delete();
    }
}
