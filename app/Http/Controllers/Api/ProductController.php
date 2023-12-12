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
        $data = $request->validated();
        $image = $request->file('image');
        if($request->hasFile('image') && $image->isValid()){
            $nameFile = str()->uuid() . '.' . $image->extension();
            $data['image'] = $nameFile;
            $upload = $image->move('products', $nameFile);
            if(!$upload){
                return response()->json(['error' => 'Upload Failed'], 500);
            }
        }
        $product = $this->product->create($data);

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
        $data = $request->validated();
        $image = $request->file('image');
        if($request->hasFile('image') && $image->isValid()){
            if($product->image){
                $name = $product->image;
                $imagePath = public_path('products/'.$name);
                if(file_exists($imagePath)){
                    unlink($imagePath);
                }
            }
            $nameFile = str()->uuid() . "." . $image->extension();
            $data['image'] = $nameFile;
            $upload = $image->move('products', $nameFile);
            if(!$upload){
                return response()->json(['error' => 'Upload Failed'], 500);
            }
        }
        $product->update($data);

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
