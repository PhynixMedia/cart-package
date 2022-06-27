<?php

namespace Cart\App\Traits;

trait Checkout 
{

    public function forget(){

        session()->forget('checkout');
        session()->forget('order_code');
        session()->forget('delivery_charge');
        session()->forget('discount');
        session()->forget('customer');
        session()->forget('voucher');
        // session()->forget('total');
    }

    public function setOrder($request){

        try{

            $data = [];
            $data['barcode']        = uniqueNumber();
            $data['shipped_date']   =  date('Y-m-d');
            $data['pickup']         =  $request->get('shipping')??NULL;
            $data['payment_option_id'] = $request->get('payoptions');
            $data['discount']       = cart_discount();
            $data['delivery_charge'] = get_option_shipping();
            $data['comment']        = $request->get('message');
            $data['order_source']   = $request->get('order_source') ?? 'in-store';
            $data['status']         = 0;

            $checkout = [
                'order'     => $data,
                'items'     => self::getOrderItems(),
            ];

            return $checkout;

        }catch(\Exception $e){

            return false;
        }
    }

    public function getOrder(){

        if($checkout = session()->get('checkout')){

            return $checkout;
        }
        return false;
    }

    private static function getOrderItems()
    {
        $items = [];

        $carts = cart('cart');

        if($carts){

            foreach($carts as $key => $cart){

                $ids = explode('|', $key);

                if(is_object($cart)){
                    $cart = (array) $cart;
                }

                $item = [];
                // $item['order_id']   = $orderid;
                $item['products_id'] = ($ids[1] == 'deal')? 0 : $ids[0]; //treat product=0 as deal if statement is true
                $item['size_id']    = ($ids[1] == 'deal')? 0 : $ids[1]; //treat size=0 as deal if statement is true
                $item['quantity']   = $cart['qty'];
                $item['unit']       = '';
                $item['price']      = $cart['price'] ?? 0;
                $item['deal_id']    = ($ids[1] == 'deal')? $ids[0] : 0;
                $item['status']     = 1;
                
                $items[] = $item;

            }

        }

        return $items;
    }

    public function getPaymentType($request){

        switch($request->get('payoptions')) {
            case 1: return 'stripe.pay';
            case 2: return 'paypal.pay';
            case 3: return 'shoppingos.pay';
            case 4: return 'bank_transfer.pay';
            default: return null;
        }
    }

}