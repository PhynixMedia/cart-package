<?php

namespace Cart\App\Traits;

trait Payments 
{

    private function getAmount()
    {
        $total = session()->get('total');

        if($total??''){
            $amount = ((float)$total->total - ((float) session()->get('discount') + $this->addVoucher()));
            return money($amount);
        }
        return 0;
    }

    /**
     * @return int
     */
    private function getQuantity()
    {
        $carts = cartValue('carts');
        return 1;
    }

    /**
     * @return string
     */
    private function getCurrency()
    {
        return 'GBP';
    }

    /**
     * @return float|int|string
     */
    private function getTotal()
    {

        if($delivery_charge = get_option_shipping()){

            return ($this->getAmount() + (float) $delivery_charge??0);
        }
        return $this->getAmount();
    }

    /**
     * @return mixed|string
     */
    private function getOrderName()
    {
        return env('APP_CHECKOUT_NAME')??'ECAPRMS-' . uniqueNumber();
    }

    /**
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function getOrderCode()
    {

        $customer = session()->get('customer');
        return $customer->ordercode??'ECAPRMS-' . code(6);
    }

    /**
     * @return float|int
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function addVoucher(){

        try{
            
            $voucher = (object) session()->get('voucher');
            return (float) $voucher->value??0;
        }catch(\Exception $e){
            return 0;
        }
    }

    /**
     * @param array $voucher
     */
    private function setVoucher($voucher = []){

        session()->put('voucher', $voucher);
        session()->save();
    }

}