<?php

namespace Cart\App\Services;

use Cart\App\Traits\CheckoutValidator;

class CartService {

    use CheckoutValidator;
    use \Store\Manager\Traits\Config;

    public function __construct(){

    }

    public function set($request){
        
        return SessionService::set($request);          
    }

    public function get($id = false){

        return SessionService::get($id);
    }

    public function remove($id){

        return SessionService::remove($id);
    }

    public function empty(){

        SessionService::clear();
    }

    /**
     * set customer order information to feramy
     */
    public function setCustomer(array $data)
    {
        $params = array_merge(self::config(),
        [
            'namex'         => $data['fname'] .' '. $data['lname'],
            'email'         => $data['email'] ?? '',
            'phone'         => $data['phone'] ?? '',
            'password'      => uniqueNumber(),
            'contact'       => $data
        ]);

        return self::customers()->enroll($params);
    }

    /**
     * get customers
     */
    public function getCustomer($data)
    {
        if($data['email'] ?? ''){

            $params = array_merge(self::config(), ['email' => $data['email'] ?? '']);
            return self::customers()->fetch($params);
        }
        return false;
    }

    /**
     * get customers 
     */
    public function setContact($request, $customerid)
    {
        $validator = $this->validateCustomer($request->all());
        if($validator->fails()){
            print 'in validator id';
            return false;
        }

        $params = array_merge(self::config(), $request->all(), ['customerid'=>$customerid]);

        return self::customers()->saveAddress($params);
    }

    public function createOrder($request){

        return  $this->checkoutRepository->set($request);
    }
}