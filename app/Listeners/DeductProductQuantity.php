<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        // dd($order->products);
            foreach($order->products as $product){

                $product->decrement('quantity',$product->pivot->quantity);
            }
    }

    // /**
    //  * Handle the event.
    //  */
    // public function handle(Collection $orders  , $user = null ): void
    // {
    //     // dd($orders->all());
         
    //     foreach($orders  as $order ){
    //             dd( $order->products );

    //         foreach($order->products as $product){
    //             // dd( $product );

    //             $product->decrement('quantity',$product->pivot->quantity);
    //         }

    //         }

    //     // foreach(Cart::get() as $item ){
    //     //     Product::where('id',$item->product_id)
    //     //     ->update([
    //     //         'quantity' => DB::raw("quantity - {$item->quantity}")
    //     //     ]);
    //     // }
    // }
}
