<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $image = 'required';

        if ($this->method() === 'PUT') {
            $image = 'nullable';
        }

        return [
            'category_id' => 'required',
            'name' => 'required|max:500',
            'image' => $image,
            'description' => 'required',
            'view' => 'required',
            'is_new' => 'required',
            'is_hot' => 'required',
            'is_best_seller' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'sản phẩm'
        ];
    }
}
