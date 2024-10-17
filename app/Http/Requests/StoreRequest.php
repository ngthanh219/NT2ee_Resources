<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'iframe' => 'nullable',
            'view' => 'required'
        ];
    }
}
