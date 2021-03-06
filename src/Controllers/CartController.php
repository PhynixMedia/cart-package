<?php

namespace Cart\App\Controllers;

use Cart\App\Requests\UpdateCartDeliveryRequests;
use Cart\App\Services\CartService;
use Cart\App\Traits\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{

    use Checkout;

    protected $cartService;
    protected $checkoutService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    /**
     * This check if coupon code is added already or not
     */
    public function checkCode($key, $code)
    {

        $discounts = session()->get($key) ?? [];
        return (array_key_exists($code, $discounts)) ? true : false;
    }

    /**
     * This list all items in the card
     */
    public function cart()
    {
        
        $carts = $this->cartService->get();

        return view('cart::cart.view', compact('carts'));
    }


    /**
     * This accepts add to cart request
     */
    public function proAddToCart(Request $request)
    {

        $carts = $this->cartService->set($request);

        if ($carts) {

            $sum = cartValue("cart");
            $total = [
                "count" => $sum->count,
                'value' => $sum->value
            ];

            return response()->json(["status" => "success", "cartdata" => $carts, "total" => $total]);
        }
        return response()->json(["status" => "danger", "cartdata" => []]);
    }

    /**
     * 
     */
    public function delivery(UpdateCartDeliveryRequests $request){

        $data = (object) $request->all();
        session()->put(env('APP_CART_DELIVERY_OPTION'), $data->option ?? 0);
        return json_encode(['status'=>true]);
    }


    /**
     * This process remove item from cart
     */
    public function delete($id)
    {
        return $this->cartService->remove($id);
    }


    /**
     * Order successfully checked out success
     */
    public function success()
    {

        session()->flash('success');
        session()->save();

//        if($this->route_check()){
//            session()->flash('success', 'Order successfully checked out');
//            session()->save();
//        }

        clear_seesion();

        $status = "success";
        return view('cart::confirm.view', compact("status"));
    }

    /**
     * Order successfully checked out cancel
     */
    public function cancel()
    {

        session()->flash('error');
        session()->save();

//        if($this->route_check()){
//            session()->flash('error', 'Order was declined, Please, verify with your bank then try again');
//            session()->save();
//        }

        $status = "error";
        return view('cart::confirm.view', compact("status"));
    }

    /**
     * Validate Route request is from Payment page
     */
    private function route_check(){

        if($url = url()->previous()){

            $split = explode('/', $url);
            $index_end = end($split);
            if($index_end === 'pay'){
                 return true;
            }
        }
        return false;
    }

//    public function confirm(Request $request){
//
//        if($request->get("status") == "success"){
//            $this->cartService->empty();
//        }
//
//        $response = (object) $request->all();
//        return view("stripe-app::confirm", compact('response'));
//    }

}
