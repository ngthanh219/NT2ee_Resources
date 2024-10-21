<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->method() === 'PUT') {
            $image = "nullable";
        } else {
            $image = "required";
        }

        return [
            "image" => $image,
            "name" => "required",
            "short_description" => "required",
            "content" => "required",
            "view" => "required",
        ];
    }
}
