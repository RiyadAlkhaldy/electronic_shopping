<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // $this->authorizeResource(Product::class, 'product');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::with(['category', 'store'])->paginate();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        $product = new Product();
        $parents = Category::all();
        return view('dashboard.products.create', compact('product', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Product::class);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        // return view('dashboard.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $tags = implode(',', $product->tags->pluck('name')->toArray());
        // dd($tags );

        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $product->update($request->except('tags'));
        // $tags = explode(',',$request->post('tags'));
        $tags = json_decode($request->post('tags'));
        $tag_ids = [];
        $all_tags = $product->tags;
        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $all_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag =  Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        // return 'helel';

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        // return redirect()->route('dashboard.products.index')->with('success', 'Product deleted');
    }
}
