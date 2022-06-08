<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'username' => 'required|max:255',
            'password' => 'required|max:255|confirmed',
            'address' => 'required|max:255',
            'contact_number' => 'required|max:255',
            'post_code' => 'required|max:255',
        ];
    }
}
