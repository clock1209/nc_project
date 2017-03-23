<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
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
            'name'              => 'required|max:60|regex:/^[A-Za-z\s]+$/',
            'details'           => 'required|max:60|regex:/^[A-Za-z\s]+$/',
            'sale_price'        => 'required|numeric',
            'production_cost'   => 'required|numeric',
            'description'       => 'max:255|nullable',
            'quantity'          => 'required|numeric',
        ];
    }
}
