<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'Required',
            'last_name' => 'Required',
            'email' => 'Email',
            'password_confirmation' => 'Required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:10000',
            'permissions' => 'Required|min:1'
        ];
    }
}
