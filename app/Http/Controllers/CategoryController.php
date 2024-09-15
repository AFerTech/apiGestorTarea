<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Filters\CategoryFilter;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoriCollection;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $filter = new CategoryFilter();
        $queryItems = $filter->transform($request);

        $categories = Category::where($queryItems)->paginate(10);
        return new CategoriCollection($categories->appends($request->query()));


    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->all());
        return response()->json([
            'message' => 'Categoria creado correctamente',
            'status' => 201,
            'date' => CategoryResource::make($category)
        ],201);
    }

    public function show(Category $category)
    {
        $includeTasks = request()->query('includeTasks');
        if($includeTasks){
            return new CategoryResource($category->loadMissing('tasks'));
        }
        return response()->json([
            'message' => 'Categoria encontrada correctamente',
            'status' => 200,
            'data' =>TaskResource::make($category),
        ], 200);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return response()->json([
            'message' => 'Categoria actualizada correctamente',
            'status' => 200,
            'date' => CategoryResource::make($category)
        ],200);
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Categoria eliminada correctamente',
            'satatus' => 200,
            'date' => CategoryResource::make($category)
        ],200);
    }
}
