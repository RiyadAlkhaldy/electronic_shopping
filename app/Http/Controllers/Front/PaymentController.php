<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    protected $stripe;
    public function __construct()
    {
        if (!$this->stripe) {
            $this->stripe = new StripeClient(config('services.stripe.secret_key'));
        }
    }



    public function create(Order $order)
    {
        return view('front.payments.create', compact('order'));
    }


    public function createStripePaymentIntent(Order $order)
    {
        $amount = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $paymentIntents = $this->stripe->paymentIntents->create([
            'amount' =>  $amount * 100,
            'currency' => 'usd',
            // 'payment_method_types' => ['card'],
            // 'payment_method' => 'pm_card_visa',
            // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);
        try {
            DB::beginTransaction();
            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntents->amount,
                'currency' => $paymentIntents->currency,
                'method' => 'stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntents->id,
                'transaction_data' => json_encode($paymentIntents),

            ])->save();
            DB::commit();
            event('payment.created', $payment->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            return;
        }
        return response()->json(['clientSecret' => $paymentIntents->client_secret]);
    }

    public function confirmStripePayment(Request $request, Order $order)
    {
        $paymentIntents = $this->stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );

        if ($paymentIntents->status === 'succeeded') {
            DB::beginTransaction();
            try {
                $order->update([
                    'payment_status' => 'paid',
                    'payment_method' => 'stripe',
                ]);
                //code...
            } catch (\Throwable $th) {
                //throw $th;
            }
            try {
                $payment =  Payment::where('order_id', $order->id)->first();
                $payment->forceFill([
                    'status' => 'paid',
                    'transaction_data' => json_encode($paymentIntents),

                ])->save();
                DB::commit();
                event('payment.created', $payment->id);
                return redirect()->route('home', [
                    'status' => 'Payment succeeded'
                ]);
            } catch (\Throwable $th) {
                DB::rollBack();
                echo $th->getMessage();
                return;
            }
        } else
            return redirect()->route('orders.payments.create', [
                'order' => $order,
                'status' => $paymentIntents->status
            ]);
    }







    public function stripeTest()
    {

        $paymentIntents = $this->stripe->paymentIntents->create([
            'amount' =>  2000,
            'currency' => 'usd',
            // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
            // 'automatic_payment_methods' => [
            //     'enabled' => true,
            // ],
        ]);

        return $paymentIntents->client_secret;









        // create a customer with no parameters
        // $customer =  $this->stripe->customers->create();
        // return $customer;

        // retrieve a customer with id
        // $customer =  $this->stripe->customers->retrieve('cus_RYzmHPrju26pVT');
        // return $customer;

        // create a customer with parameters
        // $customer =  $this->stripe->customers->create([
        //     'name' => 'John Doe',
        //     'email' => ' [email protected]',
        //     'description' => 'Customer for John Doe',
        // ]);
        // return $customer;


        // using static methods
        // Stripe::setApiKey(config('services.stripe.secret_key'));
        // return Customer::all();

        // using client service
        // $this->stripe = new StripeClient(config('services.stripe.secret_key'));
        // return $this->stripe->customers->all();
    }
}
