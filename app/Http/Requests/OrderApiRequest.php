<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderApiRequest extends FormRequest
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
            'email' => 'required|email',
            'products' => 'required',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|gt:0'
        ];
    }

    /**
     * Custom messages for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'The :attribute must be a valid email type',
            'products.required' => 'Products are required!',
            'products.*.id.required' => 'The :attribute is required!',
            'products.*.id.integer' => 'The :attribute must be an integer',
            'products.*.id.exists' => ' :attribute not found',
            'products.*.quantity.required' => 'The :attribute is required!',
            'products.*.quantity.integer' => 'The :attribute  must be an integer',
            'products.*.quantity.gt' => 'The :attribute  must be greater than zero'
            
        ];
    }


}
