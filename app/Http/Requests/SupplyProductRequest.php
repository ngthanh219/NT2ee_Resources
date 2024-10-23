<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplyProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_price_id' => 'required|integer|min:1',
            'type' => 'required|integer',
            'quantity' => 'required|integer|min:0'
        ];
    }

    public function attributes()
    {
        return [
            'type' => 'loại'
        ];
    }
}
