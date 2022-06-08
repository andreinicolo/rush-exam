<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|max:255|email|unique:users,email,'.$this->user->id,
            'username' => 'required|max:255|unique:users,username,'.$this->user->id,
            'password' => 'sometimes|max:255|confirmed',
            'address' => 'required|max:255',
            'contact_number' => 'required|max:255',
            'post_code' => 'required|max:255',
        ];
    }
}
