<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'cat_id' => 'required',
            'dep_id' => 'required',
            'man_id' => 'required',
            'product_number' => 'required',
            'upc' => 'required',
            'sku' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'description' => 'required|max:255'
        ];
    }
}
