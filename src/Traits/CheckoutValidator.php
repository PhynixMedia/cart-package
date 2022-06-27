<?php

namespace Cart\App\Traits;


use Illuminate\Support\Facades\Validator;

trait CheckoutValidator
{

    private static function validateCustomer(array $customer)
    {

        

        /**
         * This will validate customer's information
         */
        $validator = Validator::make($customer,  
        [
            'order_source'  => 'required|max:100',
			'fname'         => 'required|max:100', 
			'lname'         => 'required|max:100', 
			'phone'         => 'required|min:10|numeric',
            'email'         => 'required|email|max:120',
            'address'       => 'required|max:255',
            'city'          => 'required|max:60',
            'postcode'      => 'required|max:10',
            'country'       => 'required|max:100',
            'payoptions'    => 'required|max:3',
        ]);

        return $validator;
    }

}