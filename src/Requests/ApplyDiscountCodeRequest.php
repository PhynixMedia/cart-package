<?php

namespace Carts\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyDiscountCodeRequest extends FormRequest
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

        return [
            'coupon_code'  => 'required|max:10',
        ];
    }
}
