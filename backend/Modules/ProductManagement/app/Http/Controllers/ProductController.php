<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ProductManagement\Http\Requests\ProductCreateRequest;
use Modules\ProductManagement\Http\Requests\ProductUpdateRequest;
use Modules\ProductManagement\Models\Product;
use Modules\ProductManagement\Services\Contracts\ProductContract;
use Modules\ProductManagement\Transformers\ProductResource;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductContract $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->listProducts($request->all());

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products['data']),
            'meta' => $products['meta'],
        ]);
    }

    public function store(ProductCreateRequest $request)
    {
        try {
            $product = $this->productService->createProduct($request->validated());

            return response()->json([
                'success' => true,
                'data' => new ProductResource($product),
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(ProductUpdateRequest $request, $product_id)
    {
        $product = Product::find($product_id);

        if (! $product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        try {
            $updatedProduct = $this->productService->updateProduct($product_id, $request->validated());

            return response()->json([
                'success' => true,
                'data' => new ProductResource($updatedProduct),
                'message' => 'Product updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function destroy($product_id)
    {
        $product = Product::find($product_id);

        if (! $product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        try {
            $this->productService->deleteProduct($product_id);

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
