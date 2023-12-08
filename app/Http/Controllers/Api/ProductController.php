<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
