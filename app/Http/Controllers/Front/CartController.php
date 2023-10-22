<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    protected $cart;
    /**
     * Display a listing of the resource.
     */
    public function __construct(CartRepository $cart){
        $this->cart = $cart;
    }

    public function index( )
    {
        return view('front.cart', [
            'cart'=> $this->cart,
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity' =>['nullable','int','min:1']
        ]);

        $product = Product::findOrfail($request->post('product_id'));

        $this->cart->add($product,$request->post('quantity'));
        if($request->acceptsJson()){
            return response()->json([
                'message' => 'product added to cart',
            ],201);
        }
        return redirect()->route('cart.index')->with('success','product added to cart');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'quantity' =>['required','int','min:1']
        ]);
        $this->cart->update($id,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->cart->delete($id);
        Cart::destroy($id);
        return [
            'message'=> 'item delete success'
        ];
    }
}