<?php

namespace App\Http\Requests\Favorite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FavoriteRequest extends FormRequest
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
            'product_id' => 'exists:App\Models\Product,id',
            'user_id'    =>'exists:App\User,id|in:' . Auth::user()->id ,
        ];
    }
}