<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteCreateRequest extends FormRequest
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
            'client'            =>  'nullable|max:60|regex:/^[A-Za-z\s]+$/',
            'phone_number'      =>  'nullable',
            'email'             =>  'nullable|email|max:100',
            'address'           =>  'nullable|max:255',
            'description'       =>  'required',
            'budget'            =>  'required|regex:/^[\d]+$/',
            'expiration_date'   =>  'required',
        ];
    }
}
