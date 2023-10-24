<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if($cart->get()->count() == 0){
            return redirect()->route('home');
        }
        // dd($cart->get()->groupBy('products.store_id')->all());
        return view('front.checkout',[
            'cart'=>$cart,
            'countries'=>Countries::getNames(),
        ]);
    }

    public function store(Request $request,CartRepository $cart)
    {
        $request->validate([
            'addr.billing.first_name'=> ['required','string','max:255'],
            'addr.billing.last_name'=> ['required','string','max:255'],
            'addr.billing.email'=> ['required','string','max:255'],
            'addr.billing.city'=> ['string','max:255'],
            'addr.billing.phone_number'=> ['string','max:255'],
        ]);
        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        $order = collect();
        try {
            foreach ($items as $store_id => $cart_items) {
              // dd($items);
                $order  = Order::create([
                    'store_id' => $store_id,
                    'user_id' =>Auth::id(),
                    'payment_method' =>'cod',
                ]);

                foreach($cart_items as $item){
                    OrderItem::create([
                        'order_id' =>$order->id,
                        'product_id' =>$item->product_id,
                        'product_name' =>$item->product->name,
                        'price' =>$item->product->price,
                        'quantity' =>$item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    // dd($request->post('addr'));
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }

            }

                // event('order.created',$order,Auth::user());
                event(new OrderCreated($order));
                DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            throw $e;
        }
        // return redirect()->route('home');

    }
}
