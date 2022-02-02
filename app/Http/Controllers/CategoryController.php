<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\UpdateCategoryRequest;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $data = Category::all();
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();

        try{
            Category::whereId($category->id)
                ->update([
                    'name' => $data['name']
                ]);
           return response()->json(null, 204);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Category name already exists.'], 409);
        }
        catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Could not update category.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        try {
            Category::destroy($category->id);
            return response()->json(null, 204);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Could not delete category.'], 500);
        }
    }
}
