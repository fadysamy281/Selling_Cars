<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

        ];
    }
    public function messages(){
        return [
            
                            'name.required'=>"name is required",
                'name.string'=>"provide name of valid characters",
                'name.min'=>"name can't be less than 3 characters",
                'name.max'=>"name can't be more than 40 characters",
            
        ];   
    }
}
