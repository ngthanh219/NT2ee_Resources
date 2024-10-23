<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPriceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'attribute_ids' => 'nullable|array',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0|max:999999999',
            'sale_percent' => 'required|numeric|min:0|max:100',
            'sale_price' => 'required|numeric|min:0|max:999999999'
        ];
    }
}
