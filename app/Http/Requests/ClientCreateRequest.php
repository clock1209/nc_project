<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:255|alpha',
            'lastNameFather'    => 'required|max:255|alpha',
            'lastNameMother'    => 'nullable|max:255|alpha',
            'email'             => 'required|email|max:255|unique:users',
            'address'           => 'max:255|nullable',
            'homePhone'         => 'nullable|numeric|digits_between:8,13',
            'cellPhone'         => 'nullable|numeric|digits_between:8,13',
        ];
    }
}
