<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'pro_name'      => 'string|regex:/^[a-zA-Z ]+$/',
            'pro_des'       => 'string',
            'price'         => 'between:0,99.99',
            'category_id'   => 'exists:App\Models\Category,id',
            'pro_rate'      => 'integer|digits_between:1,5',
            'pro_gender'    => 'required|in:'. implode(',',['M','F','B']),
            'favHeader'     => 'boolean',
            'trending'      => 'boolean',
        ];
    }
}
