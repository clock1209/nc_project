<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSupportRequest extends FormRequest
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
            'date' => 'required',
            'client' => 'required',
            'description' => 'nullable',
            'attentiontime' => 'required|regex:/^\s?\d{1,2}[dwhm]\s?(\d{1,2}[dhm]\s?(\d{1,2}[hm]\s?)?)?$/',
        ];
    }
}


// \d\d?dhm\s*$