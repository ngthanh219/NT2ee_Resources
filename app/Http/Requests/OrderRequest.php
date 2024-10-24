<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $storeId = 'nullable';
        $userId = 'required';
        $product = 'required';

        if ($this->input('user_id') == 0) {
            $userId = 'required|numeric|min:1';
        }

        if (config('base.env.multi_store')) {
            $storeId = 'required';
        }

        if ($this->method() === 'PUT') {
            $userId = 'nullable';
            $product = 'nullable';
            $storeId = 'nullable';
        }

        return [
            'user_id' => $userId,
            'store_id' => $storeId,
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone' => 'required|regex:/(0)[0-9]{9}/|digits:10',
            'address' => 'required',
            'note' => 'nullable',
            'status' => 'required',
            'is_paid' => 'required',
            'product' => $product
        ];
    }

    public function messages()
    {
        return [
            'user_id.min' => 'Trường tài khoản không được bỏ trống'
        ];
    }
}
