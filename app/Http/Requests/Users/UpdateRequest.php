<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name'  => 'required|min:3|max:255|string',
            'email' => [
                'required',
                'min:3',
                'max:255',
                'email'
                ],
            'password' => 'required|string'
        ];
        if (!empty($this->user)) {
            $rules['email'][] = Rule::unique('users')->ignore($this->user->id);
        } else {
            $rules['email'][] = Rule::unique('users');
        }
        return $rules;
    }
}
