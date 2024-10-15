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
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'danh mục',
            'name' => 'sản phẩm'
        ];
    }
}
