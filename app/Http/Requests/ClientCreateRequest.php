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
            'lastNameFather'    => 'required|max:60|regex:/^[A-Za-z\s]+$/',
            'lastNameMother'    => 'nullable|max:60|regex:/^[A-Za-z\s]+$/',
            'email'             => 'required|email|max:100|unique:users',
            'address'           => 'max:255|nullable',
            'homePhone'         => 'nullable|min:8|max:15|regex:/^[1-9\(\)\-]+$/',
            'cellPhone'         => 'nullable|min:8|max:15|regex:/^[1-9\(\)\-]+$/',
        ];
    }
}
