<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    private $product, $totalPage;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $products = $this->product->getResults($request->all(), $this->totalPage);

        return response()->json($products);
    }
    
    public function store(StoreUpdateProductRequest $request)
    {
        $product = $this->product->create($request->all());

        return response()->json($product, 201);
    }

    
    public function show(string $id)
    {
        if(!$product = $this->product->find($id)){
            return response()->json(['error' => 'Not Found'], 404);
        }
        return response()->json($product);
    }

    
    public function update(StoreUpdateProductRequest $request, string $id)
    {
        if(!$product = $this->product->find($id)){
            return response()->json(['error' => 'Not Found'], 404);
        }
        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy(string $id)
    {
        if(!$product = $this->product->find($id)){
            return response()->json(['error' => 'Not Found'], 404);
        }
        $product->delete();

        return response()->json(['success' => true], 204);
    }
}
