<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailsRequest extends FormRequest
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
            'quantity'=>'required|integer|min:1',
            'unitprice'=>'required|decimal|min:0',
            'discount'=>'decimal'
        ];
    }

    public function messages(){
        return [
                'quantity.required'=>"price is required",
                'quantity.integer'=>"price must be  integer",
                'quantity.min'=>"quantity can not be negative",          
                'price.required'=>"price is required",
                'price.decimal'=>"price must be numeric value",
                'price.min'=>"price can not be negative",            
                'discount.decimal'=>"discount must be floating value",
            
            
        ];
    }


}
