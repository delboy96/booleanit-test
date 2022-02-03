<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\UpdateProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
     * @param int $cat_id
     * @return StreamedResponse
     */
    public function exportCsv (int $cat_id)
    {
        $cat_name = Category::find($cat_id)->name;
        $cat_name_alphanum = preg_replace("/[^A-Za-z0-9]/", '_', $cat_name);
        $timestamp = Carbon::now()->format('Y_m_d-H_i');
        $filename = $cat_name_alphanum . '_' . $timestamp;

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
            ,   'Content-type'        => 'text/csv'
            ,   'Content-Disposition' => 'attachment; filename='.$filename.'.csv'
            ,   'Expires'             => '0'
            ,   'Pragma'              => 'public'
        ];

        $list = Product::whereCatId($cat_id)->get()->toArray();

        # add headers for each column in the CSV download
        array_unshift($list, array_keys($list[0]));

        $callback = function() use ($list)
        {
            $FH = fopen('php://output', 'w');
            foreach ($list as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($callback, 200, $headers);
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
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            Product::destroy($product->id);
            return response()->json(null, 204);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Could not delete product.'], 500);
        }
    }
}
