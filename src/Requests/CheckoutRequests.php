<?php

namespace Carts\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //address_2, message, company
        return [
            'order_source'  => 'required|max:100',
			'fname'      => 'required|max:100', 
			'lname'      => 'required|max:100', 
			'phone'      => 'required|min:10|numeric',
            'email'      => 'required|email|max:120',
            'address'    => 'required|max:255',
            'city'       => 'required|max:60',
            'postcode'   => 'required|max:10',
            'country'    => 'required|max:100',
            'payoptions' => 'required|max:3',
            'shipping'   => 'required',
        ];
    }
}
