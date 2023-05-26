<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => 'required|min:3|max:255|string',
            'email'    => 'required|min:3|max:255|email|unique:users,email',
            'password' => 'required|string|min:8'
        ];
    }
}
