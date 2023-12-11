<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum")->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products =  Product::filter($request->query())
        ->with('store:id,name','category:id,name','tags:id,name')
        ->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' =>'required:exists:categories,id',
            'status' => 'in:active,draft,archvied',
            'price' => 'required|numeric|min:0',
            'compare_price'=> 'nullable|numeric|gt:price',
        ]);
        $user = $request->user();
        if(!$user->tokenCan('product.create')){
            return response([
                'message' => 'not allowed',
            ],403);
        }
        $product = Product::create($request->all());
        return $product
        ->load('category:id,name','store:id,name','tags:id,name') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' =>'sometimes|required|string|max:255',
            'description' => 'nullable|string|max:255',
            'category_id' =>'sometimes|required:exists:categories,id',
            'status' => 'in:active,draft,archvied',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price'=> 'nullable|numeric|gt:price',
        ]);
        $user = $request->user();
        if(!$user->tokenCan('product.udpate')){
            return response([
                'message' => 'not allowed',
            ],403);
        }
        $product->update($request->all());
        return $product
        ->load('category:id,name','store:id,name','tags:id,name') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $product =  Product::destroy($id);
         $user = Auth::user();
        //  dd($user->tokens);
        if(!$user->tokenCan('product.delete')){
            return response([
                'message' => 'not allowed',
            ],403);
        }
        return response()->json($product);
    }
}
