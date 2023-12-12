<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category, $totalPage = 10;
    public function __construct(Category $category) {
        $this->category = $category;
    }
    
    public function index(Request $request)
    {
        $category = $this->category->getResults($request->name);

        return response()->json($category);
    }

    public function show($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        return response()->json($category);
    }

    public function store(StoreUpdateCategoryRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 201);
    }

    public function update(StoreUpdateCategoryRequest $request, $id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy($id)
    {
        if(!$category = $this->category->find($id))
            return response()->json(['error' => 'Not found'], 404);

        $category->delete();
        return response()->json(['success' => true], 204);
    }

    public function products($id)
    {
        if(!$category = $this->category->find($id)){
            return response()->json(['error' => 'Not Found'], 404);
        }
        $products = $category->products()->paginate($this->totalPage);

        return response()->json([
            'category' => $category,
            'products' => $products
        ]);
    }
}
