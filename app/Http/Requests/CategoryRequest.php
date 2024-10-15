<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'view' => 'required',
            'parent_id' => 'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên danh mục'
        ];
    }
}
