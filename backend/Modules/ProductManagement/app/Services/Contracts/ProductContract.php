<?php

namespace Modules\ProductManagement\Services\Contracts;

interface ProductContract
{
    public function listProducts(array $filters, int $page = 10): array;

    public function createProduct(array $data): object;

    public function updateProduct(int $productId, array $data): object;

    public function deleteProduct(int $productId): bool;
}
