<?php

namespace Cart\App\Services;

use App\Services\Service;
use Cart\App\Traits\CheckoutValidator;
use Cart\App\Repositories\CheckoutRepository;

class CheckoutService extends Service {

    use CheckoutValidator;
    use \Store\Manager\Traits\Config;

    public function __construct(){
        
        $this->repository = new CheckoutRepository();
    }

    /**
     * Update order status from the payment webhook
     * 0 = pending
     * 1 = payment confirmed
     * 2 = order processed
     * 3 = order declined
     * 4 = refund processed
     */
    public function updateOrder(string $order_code, int $status = 0)
    {

        $target = ["order_code" => $order_code];
        $param = ["status" => $status];
        $id =  $this->repository->update($param, $target);

        if(! $id ){
            return false;
        }

        /**
         * This is to test event effect on webhook
         * if failed, use cronjob
         */
//        event(new OnOrderFulFilled($target));
    }

    /**
     * This method should be called by cron job or any long process background task
     */
    public function fulfillOrder(array $order = null){

        try{

            $order = (object) $order ?? [];

            $order_code = $order->order_code ?? null;

            if(! $order_code)
            {
                return false;
            }

            $order_details = $this->fetchOrder($order->order_code);

            if(! $order_details )
            {
                return false;
            }
            
            /**
             * Send order to server
             */
            if($order = $order_details->toArray() ?? ''){
                $this->sendOrder($order);
            }

        }catch(\Exception $e){
            return null;
        }

        return null;
    }

    /**
     *
     */
    public function fetchOrder(string $order_code = null)
    {
        return  $this->repository->fetchOne(["order_code"=>$order_code]);
    }

    /**
     * set orders
     */
    public function sendOrder(array $checkout)
    {

        try{

            /**
             * convert json data from database back to array
             */
            $checkout['customerid'] = $checkout['customer_id'];
            $checkout['addressid'] = $checkout['address_id'];
            $checkout['cart_checkout'] = json_decode($checkout['cart_checkout']);

            $params = array_merge(self::config(), $checkout);

            return self::orders()->place($params);

        }catch(\Exception $e){
            return false;
        } 
    }

    
}