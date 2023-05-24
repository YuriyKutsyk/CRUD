<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required|min:3|max:255|string',
            'email'    => 'required|unique:users,email|min:3|max:255|email',
            'password' => 'required|string'
        ];
    }
}
