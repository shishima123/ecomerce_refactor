<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|unique:products,name',
            'parent_id' => 'required',
            'price' => 'required',
            'txtDescription' => 'required',
            'txtContent' => 'required',
            'productImage' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name Product',
            'name.unique' => 'Product Name is exist',
            'price.required' => 'Please Enter Price Product',
            'parent_id.required' => 'Please Enter Category Product',
            'txtDescription.required' => 'Please Enter Description Product',
            'txtContent.required' => 'Please Enter Content Product',
            'productImage.required' => 'Please Enter Image Product',
        ];
    }
}
