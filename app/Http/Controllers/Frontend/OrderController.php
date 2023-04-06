<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Mail\OrderConfirmationMail;
use App\Models\DeliverAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe;



class OrderController extends Controller
{
    //
    public function checkout($id = null)
    {   
        
        if ($id == null) {
            $count = Cart::where('user_id', Auth::user()->id)->count();
            if ($count == 0) {
                return redirect()->back()->with('error', 'Your cart is empty');
            }
            $userCarts = Cart::where('user_id', Auth::user()->id)->get();
            // out of stock
            foreach ($userCarts as $cart) {
                $product = Product::where('id', $cart->product_id)->first();
                
                if ($product->quantity < $cart->quantity ) {
                    return redirect()->back()->with('error', 'Product ' . $product->name . ' is out of stock');
                }
            }
            $count = DeliverAddress::where('user_id', Auth::user()->id)->count();
            $get_product_id = Cart::where('user_id', Auth::user()->id)->pluck('product_id');
            if ($count > 0) {
                $address = DeliverAddress::where('user_id', Auth::user()->id)->first();
            } else {
                $address = null;
            }
            $from = 'cart';
            return view('frontend.shipping')->with(compact('userCarts', 'from', 'address'));
        } else {
            // buy now checkout
            $product = Product::where('id', $id)->first();
            // seller token balance is zero
            if ($product->quantity < 1 ) {
                return redirect()->back()->with('error', 'Product ' . $product->name . ' is out of stock');
            }
            $userCarts = [];
            $count = DeliverAddress::where('user_id', Auth::user()->id)->count();
            if ($count > 0) {
                $address = DeliverAddress::where('user_id', Auth::user()->id)->first();
            } else {
                $address = null;
            }
            $from = 'buy_now';
            return view('frontend.shipping')->with(compact('product', 'from', 'address','userCarts'));
        }
    }

    public function saveAddress(Request $request)
    {
        // save address to my account
        $data = $request->all();
        $count = DeliverAddress::where('user_id', Auth::user()->id)->count();
        if ($count > 0) {
            $address = DeliverAddress::where('user_id', Auth::user()->id)->first();
            $address->user_id = Auth::user()->id;
            $address->name = $data['name'];
            $address->address = $data['address'];
            $address->state = $data['state'];
            $address->country = $data['country'];
            $address->zipcode = $data['zipcode'];
            $address->phone = $data['phone'];
            $address->save();
        } else {
            $address = new DeliverAddress();
            $address->user_id = Auth::user()->id;
            $address->name = $data['name'];
            $address->address = $data['address'];
            $address->state = $data['state'];
            $address->country = $data['country'];
            $address->zipcode = $data['zipcode'];
            $address->phone = $data['phone'];
            $address->save();
        }
        return redirect()->back()->with('flash_message_success', 'Address has been saved');
    }

    public function placeOrder(Request $request)
    {
        
        $request->validate([
            'shipping_name' => 'required',
            'shipping_phone' => 'required',
            'shipping_address' => 'required',
            'shipping_state' => 'required',
            'shipping_country' => 'required',
            'shipping_zipcode' => 'required',
            'billing_address' => 'required',
            'billing_state' => 'required',
            'billing_country' => 'required',
            'billing_zipcode' => 'required',

        ]);

        try {
            // dd($request->all());
            $data = $request->all();
            // if product is Out of stock
            foreach ($data['product_id'] as $key => $value) {
                $product = Product::where('id', $value)->first();
                if ($product->quantity < $data['quantity'][$key]) {
                    return redirect()->back()->with('error', 'Product is out of stock');
                }
            }
            // create a random unique order number
            $order_number = mt_rand(100000000, 999999999);
            if ($data['payment_method'] == 'stripe') {
                  
                $stripe = Stripe::setApiKey(env('STRIPE_SECRET')); 
                      
                //we have to create a customer for payment
                 $customer = $stripe->customers()->create(array(
                    'address' => [
                        'line1' => $data['shipping_address'],
                        'postal_code' => $data['shipping_zipcode'],
                        'state' => $data['shipping_state'],
                        'country' => $data['shipping_country'],
                    ],
                    "email" => Auth::user()->email,
                    "name" => $data['shipping_name'],
                    "source" => $data['stripeToken']
                ));

             
                // create a charge for created customer 
         
                $charge = $stripe->charges()->create([
                    "amount" => $data['total_amount'],
                    "currency" => 'USD',
                    "customer" => $customer['id'],
                    "description" => "Payment for product order",
                    'shipping' => [
                        'name' => $data['shipping_name'],
                        'address' => [
                            'line1' => $data['shipping_address'],
                            'postal_code' => $data['shipping_zipcode'],
                            'state' => $data['shipping_state'],
                            'country' => $data['shipping_country'],
                        ],
                    ],
                ]);

               
                if ($charge['status'] == 'succeeded') {
                    // token will be deducted from seller account
                    $count_product = count($data['product_id']);
                    // save order
                    $order = new Order();
                    $order->user_id = Auth::user()->id;
                    $order->order_number = $order_number;
                    $order->shipping_name = $data['shipping_name'];
                    $order->shipping_phone = $data['shipping_phone'];
                    $order->shipping_address = $data['shipping_address'];
                    $order->shipping_state = $data['shipping_state'];
                    $order->shipping_country = $data['shipping_country'];
                    $order->shipping_zipcode = $data['shipping_zipcode'];
                    $order->billing_address = $data['billing_address'];
                    $order->billing_state = $data['billing_state'];
                    $order->billing_country = $data['billing_country'];
                    $order->billing_zipcode = $data['billing_zipcode'];
                    $order->payment_method = $data['payment_method'];
                    $order->grand_total = $data['total_amount'];
                    $order->order_status = 'Order Confirmed';
                    $order->save();

                    $order_id = DB::getPdo()->lastInsertId();
                    $product_id = $data['product_id'];
                    foreach ($product_id as $key => $value) {
                        $product = Product::where('id', $value)->first();
                        $product->quantity = $product->quantity - $data['quantity'][$key];
                        $product->save();
                        $orderItems = new OrderItem();
                        $orderItems->order_id = $order_id;
                        $orderItems->product_id = $value;
                        $orderItems->product_quantity = $data['quantity'][$key];
                        $orderItems->product_price = $product->price;
                        $orderItems->product_name = $product->name;
                        $orderItems->save();
                        // delete product from cart
                        Cart::where('user_id', Auth::user()->id)->where('product_id', $value)->delete();
                    }
                } else {
                    return 'paypal';
                }
                // payment method save
                $payment = new Payment();
                $payment->order_id = $order_id;
                if ($data['payment_method'] == 'stripe') {
                    $payment->transaction_id = $charge['id'];
                } else {
                    $payment->transaction_id = 'paypal';
                }

                $payment->payment_method = $data['payment_method'];
                $payment->payment_status = 'Completed';
                $payment->payment_amount = $data['total_amount'];
                $payment->payment_currency = 'USD';
                $payment->save();

                Mail::to(Auth::user()->email)->send(new OrderConfirmationMail($order));
                Session::put('order_id', $order_id);
                return redirect()->route('order.success')->with('success', 'Order has been placed successfully');
            } else {
                return redirect()->back()->with('error', 'Payment failed');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return back()->with('error', $th->getMessage());
        }
    }

    public function orderSuccess()
    {
        if (Session::has('order_id')) {
            return view('frontend.thanks');
        } else {
            return redirect()->route('cart');
        }
    }
}
