<?php

namespace Cart\App\Services;

use Cart\App\Traits\Payments;
use Cart\App\Traits\Checkout;
use Cart\App\Services\CheckoutService;

class PaymentService extends CheckoutService {

    
    use Payments;
    use Checkout;

    public function __construct(){

        parent::__construct();
    }

    public function payData(){
        
    return (object)[
                "orderid"  => $this->getOrderCode(),
                "amount"    => $this->getAmount(),
                "currency"  => $this->getCurrency(),
                "total"     => $this->getTotal(),
                "name"      => $this->getOrderName(),
                "quantity"  => $this->getQuantity()
        ];
    }

    /**
     * Update order status from the payment webhook
     * 0 = pending
     * 1 = payment confirmed
     * 2 = order processed
     * 3 = order declined
     * 4 = refund processed
     */
    public function payConfirmed($event){

        $orderid = $event->data->object->metadata->order_id ?? '';

        // update this record in database
        $this->updateOrder($orderid, 1);

        /**
         * Clear all payment sessions
         */
        clear_seesion();

    }

}