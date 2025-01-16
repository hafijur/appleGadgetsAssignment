<?php

namespace Modules\ProductManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ProductManagement\Http\Requests\ProductCreateRequest;
use Modules\ProductManagement\Http\Requests\ProductUpdateRequest;
use Modules\ProductManagement\Models\Product;
use Modules\ProductManagement\Transformers\ProductResource;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('SKU')) {
            $query->where('SKU', 'like', '%' . $request->input('SKU') . '%');
        }

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $products = $query->with('category')->paginate(10);

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products->items()),
            'meta' => [
                'current_page' => $products->currentPage(),
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'prev_page' => $products->previousPageUrl(),
                'next_page' => $products->nextPageUrl(),
                'last_page' => $products->lastPage()
            ]
        ]);
    }
    public function store(ProductCreateRequest $request)
    {
        try {
            $product = Product::create([
                ...$request->validated(),
                'current_stock_quantity' => $request->input('initial_stock_quantity')
            ]);

            return response()->json([
                'success' => true,
                'data' => new ProductResource($product)
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => new ProductResource($product),
            'message' => 'Product updated successfully',
        ]);
    }

    public function destroy($product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        try {
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
