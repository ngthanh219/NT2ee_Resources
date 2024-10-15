<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => 'required|integer',
            'name' => 'required|max:255',
            'description' => 'nullable|max:500'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'loại sản phẩm'
        ];
    }
}
