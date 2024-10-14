<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = null;

        if ($this->method() === 'PUT') {
            $id = $this->route('user');
        }

        return [
            "role_id" => "required",
            "name" => "required|max:255",
            "email" => "required|max:255|email|unique:users,email," . $id,
            "phone" => "nullable|regex:/(0)[0-9]{9}/|digits:10|unique:users,phone," . $id,
            "address" => "nullable"
        ];
    }
}
