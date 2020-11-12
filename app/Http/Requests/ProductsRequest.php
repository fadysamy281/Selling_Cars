<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
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
            'name'=>'required|string|min:3|max:40',
            'photo'=>'nullable|image',
            'description'=>'required|string|min:3|max:100',
            'price'=>'required|decimal|min:0',
            'quantity'=>'required|integer|min:0',
            
        ];}

    public function messages(){
        return [
                'name.required'=>"name is required",
                'name.string'=>"provide name of valid characters",
                'name.min'=>"name can't be less than 3 characters",
                'name.max'=>"name can't be more than 40 characters",
            //  'phot.required'=>"image is required",
                'photo.image'=>"provide valid image",
                'description.required'=>"description is required",
                'description.string'=>"provide description of valid characters",
                'description.min'=>"description can't be less than 3 characters",
                'description.max'=>"description can't be more than 100 characters",
                'price.required'=>"price is required",
                'price.decimal'=>"price must be numeric value",
                'price.min'=>"price can not be negative",
                'quantity.required'=>"price is required",
                'quantity.integer'=>"price must be  integer",
                'quantity.min'=>"quantity can not be negative",        
        
        ];
    }
}
