<?php

namespace Cart\App\Services;

class SessionService
{
    /**
     * Get Store Cart
     */
    public static function get($productid = false){

        $cart = session()->get('cart');
        if(is_string($cart)){
            $cart = json_decode($cart);
        }

        if($cart && $productid){

            if(array_key_exists($productid, $cart)){
                return $cart[$productid];
            }
            return false;
        }
        return $cart ?? [];
    }

     /**
     * Set Store Cart
     */
    public static function set($request){

        $oldcart = $cart = self::get();

        //clear old cart
        self::clear();

            //continue from here
            if($cart){
                if(count($cart) == 0){ $cart = []; }
            }

            $productid = $request->get('id');
            $item_data = $request->get('item_data');
            $isReduced = $request->get('reduced');

            if(is_object($cart)) { $cart = (array) $cart; }
           
            if(array_key_exists($productid, (array) $cart)){

                if($isReduced == 0){
                    $cart[$productid]['qty'] -= 1; 
                }else{ 

                    $qty = $item_data['qty'] ?? 0;

                    if($qty > 1)
                    {
                        $cart[$productid]['qty'] += $qty; 
                    }else
                    {
                        $cart[$productid]['qty'] += 1; 
                    }
                }
                
                if($cart[$productid]['qty'] < 1){
                    $cart[$productid]['qty'] = 1 ;
                }
                
            }else{
                $cart[$productid] = $item_data;
            }

            session()->put('cart', $cart);
            session()->save();

            /**
             * Save Data into Cart Cookies
             */
            _cookie("cart", json_encode($cart));

            return self::get();
    }

    /**
     * @param $id
     * @return array|false|mixed
     */
    public static function remove($id){

        $cart = self::get();

        if($cart && array_key_exists($id, $cart)){
            unset($cart[$id]);
            self::clear();
            session()->put('cart', $cart);
        }
        return self::get();
    }

    public static function clear(){

        session()->forget('cart');
    }

}