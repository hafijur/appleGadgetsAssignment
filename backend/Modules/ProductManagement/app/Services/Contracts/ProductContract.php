<?php

namespace Modules\ProductManagement\Services\Contracts;

use Illuminate\Http\Request;

interface ProductContract
{
    public function listProducts(array $filters, int $page = 10): array;

    public function createProduct(array $data): object;

    public function updateProduct(int $productId, array $data): object;

    public function deleteProduct(int $productId): bool;
}
