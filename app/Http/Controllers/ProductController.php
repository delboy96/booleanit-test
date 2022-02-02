<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = Product::all();
        return response()->json($data, 200);
    }


    /**
     * Display products of a certain category.
     *
     * @param int $cat_id
     * @return JsonResponse
     */
    public function show(int $cat_id)
    {
        $data = Product::whereCatId($cat_id)->get();
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();

        try {
            Product::whereId($product->id)
                ->update([
                    'cat_id' => $data['cat_id'],
                    'dep_id' => $data['dep_id'],
                    'man_id' => $data['man_id'],
                    'product_number' => $data['product_number'],
                    'upc' => $data['upc'],
                    'sku' => $data['sku'],
                    'regular_price' => $data['regular_price'],
                    'sale_price' => $data['sale_price'],
                    'description' => $data['description']
                ]);
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Could not update product.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        try {
            $delete = Product::destroy($product->id);
            echo('Product successfully deleted!');

        } catch (Exception $e) {
            Log::error($e->getMessage());
            echo('Error.');
        }
    }
}
