<?php

namespace Cart\App\Controllers;

use Cart\App\Services\CartService;
use Cart\App\Services\CheckoutService;
use Cart\App\Services\DiscountService;
use Exception;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Cart\App\Traits\CheckoutValidator;
use Cart\App\Traits\Checkout;
use Symfony\Component\Console\Input\Input;

class CheckoutsController extends Controller {

    use CheckoutValidator;
    use Checkout;

    protected $cartService;
    protected $checkoutService;

    public function __construct(){

        $this->cartService = new CartService();
        $this->checkoutService = new CheckoutService();
    }

    /**
     * Get request: This is for checkout form request
     */
    public function checkout(){

        $carts = $this->cartService->get();
        return view('cart::checkout.view', compact('carts'));
    }

    public function store(Request $request){

//        $user = user_account_data();

        $payload = $account = [];

        if($auth = auth_account_data()){
            $account["customer_id"] = _value($auth, 'customer_id');
            $account["address_id"] = $request->get('selected_delivery_address_id');
            $account["selected_delivery_address"] = $request->get("selected_delivery_address");
        }

        if(! $request->get("selected_delivery_address")){
            $validator = self::validateCustomer($request->all());
            if($validator->fails()){
                return back()->withError('One or More Required fields are missing')->withInput();
            }

            $payload["address"] = json_encode([
                "phone" => $request->get("phone"),
                "address_1" => $request->get("address_1"),
                "city" => $request->get("city"),
                "country" => $request->get("country"),
                "postcode" => $request->get("postcode"),
                "status"   => 1
            ]);
        }

        $payload["account"] = json_encode($account);
        $payload['order_code'] = strtoupper(code(8));
        $payload["order"] = json_encode($this->setOrder($request));

        /**
         * set this order to session for
         * other checkout processes
         */
        session()->put('checkout', $payload);
        session()->save();

        // set to database
        $payload["status"] = 0;
        if( $this->checkoutService->set(map_request($payload))) {

            if(! $value = _value(cartValue("cart"), "value", false)){
                return back()->withErrors(["error" => "Invalid shopping cart value. Please add some items to your cart!"]);
            }

            session()->put(\Stripe\App\StripeConstants::CHECKOUT_TOTAL, $value);
            session()->put(\Stripe\App\StripeConstants::CHECKOUT_ITEMS, []);
            session()->put(\Stripe\App\StripeConstants::CHECKOUT_REFERENCE, $payload['order_code']);

            if (!$route = $this->getPaymentType($request)) { // go to payment
                return back()->withErrors(["error" => "Invalid payment type selected"]);
            }
            return redirect()->to(route($route));
        }

        return back();
    }

    public function _store(Request $request)
    {

        set_options_shipping($request->get('option'));

        try
        {

            $delivery_address = [];

            if($auth = auth_account_data()){

                $customerid = _value($auth, 'customer_id');
                if(! $customerid){
                    return back()->withError('One or More Required fields are missing')->withInput();
                }

                if($address_id = $request->get('delivery_address_id')){

                    $delivery_address['address_id'] = $address_id;
                    $delivery_address['customer_id'] = $customerid ?? null;

                }else{

                    //Set new Address here
                    $response = $this->cartService->setContact($request, $customerid);
                    if(! $response ){
                        return back()->withErrors('One or More Required fields are missing')->withInput();
                    }

                    $customer = _parser($response->customer);

                    $delivery_address['address_id'] = $customer->address_id ?? '';
                    $delivery_address['customer_id'] = $customerid;
                }

            }else{

                $validator = self::validateCustomer($request->all());

                if($validator->fails()){

                    return back()->withError('One or More Required fields are missing')->withInput();
                }

                /**
                 * This set customer details and contacts
                 */
                if($response = $this->cartService->setCustomer($request->all()))
                {

                    $customer = _parser($response->customer ?? ''); // continue from here

                    if(! $customer )
                    {
                        return back()->withError('Unable to checkout your order')->withInput();
                    }

                    $delivery_address['address_id'] = $customer->address_id ?? '';
                    $delivery_address['customer_id'] = $customer->customer_id ?? null;
                }
            }

            // 
            if(count($delivery_address) == 0){

                return back()->withErrors('One or More Required fields are missing')->withInput();
            }

            /**
             * set delivery values
             */
            $delivery_address['ordercode'] = strtoupper(code(8));

            /**
             * pass order information to setOrder method 
             * in Checkout trait
             */
            $order_details = $this->setOrder($request, (object) $delivery_address);
            if(! $order_details){

                return back()->withErrors('One or More Required fields are missing')->withInput();
            }

            /**
             * set order details to database
             */
            $this->cartService->createOrder(map_request($order_details));

            $total = (array) total();
            $this->proceedToPayment($delivery_address, $total, cart_discount(), $request->get('payoptions'));

            //set redirect location based on payment option 
            switch($request->get('payoptions')){
            case 1:
                /**
                 * for stripe payment
                 */
                return redirect()->to(route('stripe.checkout'));
            break;
            case 2:
                /**
                 * Form paypal check out
                 */
                return redirect()->to(route('paypal.checkout'));
            break;
            default:
                /**
                 * redirect user back to cart
                 */
                return redirect()->back()->withInput(Input::all())->withError('Unable to complete order! Please email ' . env('APP_ENQUIRY'));
        }

        }catch(\Exception $e){

            //redirect to
            return back()->withError("Sorry! We are unable to process your request. Please, contact " . env('APP_ENQUIRY'));
        }
        
    }

    /**
     * @return string $order_code
     */
    private static function getOrderCode(){

        if(!session()->get('order_code'))
        {
            $order_code = code(6);

            session()->put('order_code', $order_code);
            session()->save();
        } 

        return session()->get('order_code');
    }

  
    /**
     * This will process checkout finalize
     */
    private function proceedToPayment(array $customer, array $total, string $discount, string $payment_option){

        try{

                $total = (object) $total;

                /**
                 * is delivery discounted ?
                 */
                $delivery_cost = get_option_shipping() ?? 0;

                if(env('APP_DELIVERY_DISCOUNTED'))
                {
                    $delivery_cost = ((float) $delivery_cost / 2);
                }

                /**
                 * total order with weight and shipping charge
                 */
                session()->put('delivery_charge', $delivery_cost);
                session()->put('discount', $discount);
                session()->put('customer', (object) $customer);
                session()->put('total', $total);

        }catch(Exception $e){
            /**
             * Redirect to Error Page
             */
            return redirect()->to(route('checkout.confirm'))->withError("Sorry! We are unable to process your request. Please, contact " . env('APP_ENQUIRY'));
        }
    }

}